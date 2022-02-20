<?php

namespace App\Services;

use App\Http\Controllers\Exam\ExamController;
use App\Models\Exam\Exam;
use App\Models\Exam\ExamQuestion;
use App\Models\Question\Question;
use App\Models\Question\QuestionAnswer;
use App\Models\Question\QuestionCategory;
use Illuminate\Support\Facades\Redirect;
use JetBrains\PhpStorm\NoReturn;

class ExamService
{

    private QuestionService $questionService;

    public function __construct(QuestionService $questionService)
    {
        $this->questionService = $questionService;
    }

    #[NoReturn] public function startExam(array $settings, string $examId):void
    {
        $questions = $this->questionService->mergeQuestions(
            $this->questionService->getMandatoryQuestions($settings),
            $this->questionService->getQuestions($settings)
        );
        $questionsWithAnswers = $this->questionService->mixAnswers($this->questionService->getAnswers($questions));

        $this->assignQuestionToExam($questionsWithAnswers, $examId);
    }

    public function getQuestions($examId, $attachCorrectAnswer = false): array
    {
        $exam = Exam::query()->find($examId);
        $exam_questions = $exam->questions()->get();

        $questions = [];

        foreach ($exam_questions as $question) {
            $answers = [];
            $answersIds = json_decode($question->order_answers);
            foreach ($answersIds as $answerId) {
                $answerObject = QuestionAnswer::find($answerId);
                $answers[] = [
                    'id' => $answerObject->id,
                    'value' => $answerObject->value,
                ];
            }
            $questionObject = Question::query()->where('id','=',$question->question_id)->first();
            $questions[] = [
                'id' => $questionObject->id,
                'value' => $questionObject->value,
                'image' => $questionObject->image,
                'selectedAnswer' => $question->selected_answer,
                'category' => QuestionCategory::query()->find($questionObject->category_id)->name,
                'answers' => $answers,
                'correctAnswer' => $attachCorrectAnswer ? $questionObject->getCorrectAnswer() : null
            ];
        }
        return $questions;
    }

    #[NoReturn] public function checkAnswers($examId): void
    {
        $correctAnswers = 0;
        $isPassed = 1;
        $exam = Exam::query()->where('id','=',$examId)->first();
        $exam->update([
            'is_active' => 0
        ]);

        $questions = $exam->questions()->get();
        foreach ($questions as $question)
        {
            $questionObject = Question::query()
                ->where('id','=',$question->question_id)
                ->first();

            if($questionObject->getCorrectAnswer()->first()->id === $question->selected_answer){
                $correctAnswers += 1;
            }

            if($questionObject->isMandatory())
            {
                if($questionObject->getCorrectAnswer()->first()->id !== $question->selected_answer){
                    $exam->update([
                        'mandatory_mistake' => 1
                    ]);

                    $isPassed = 0;
                }
            }
        }

        if(count($questions) - $correctAnswers > 1)
        {
            $isPassed = 0;
        }

        $exam->update([
            'is_passed' => $isPassed,
            'score' => json_encode([
                'score' => $correctAnswers,
                'maxScore' => count($questions)
            ])
        ]);
    }

    #[NoReturn] private function assignQuestionToExam(array $questionsWithAnswers, string $examId): void
    {
        $questionNumber = 1;
        foreach($questionsWithAnswers as $questionValue){
            $examQuestion = new ExamQuestion();
            $examQuestion->exam_id = $examId;
            $examQuestion->question_id = $questionValue['question']->id;
            $examQuestion->question_number = $questionNumber;
            $examQuestion->order_answers = $this->questionService->getOrderAnswersJson($questionValue['answers']);
            $examQuestion->save();
            $questionNumber += 1;
        }
    }



}

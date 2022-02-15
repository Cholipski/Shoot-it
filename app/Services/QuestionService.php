<?php

namespace App\Services;

use App\Models\Exam\Exam;
use App\Models\Exam\ExamQuestion;
use App\Models\Question\Question;
use App\Models\Question\QuestionCategory;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

class QuestionService
{

    public function startExam(array $settings, string $examId): array
    {
        $questions = $this->mergeQuestions($this->getMandatoryQuestions($settings),$this->getQuestions($settings));
        $questionsWithAnswers = $this->getAnswers($questions);
        $idQuestionsWithMixedAnswers = $this->mixAnswers($questionsWithAnswers);

        $this->assignQuestionToExam($idQuestionsWithMixedAnswers, $examId);
        return $this->getQuestionsWithAnswersArray($idQuestionsWithMixedAnswers);
    }

    public function checkAnswers(array $selectedAnswers)
    {

    }

    private function getQuestionsCount(): int
    {
        return Question::query()->where('is_delete', '=', 0)->count();
    }

    public function getAllQuestions(): Builder
    {
        return Question::query()->where('is_delete', '=', 0);
    }

    private function assignQuestionToExam(array $questionsWithAnswers, string $examId): void
    {
        $questionNumber = 1;
        foreach($questionsWithAnswers as $questionKey => $questionValue){
            $examQuestion = new ExamQuestion();
            $examQuestion->exam_id = $examId;
            $examQuestion->question_id = $questionKey;
            $examQuestion->question_number = $questionNumber;
            $examQuestion->order_answers = $this->getOrderAnswersJson($questionValue);
            $examQuestion->save();
            $questionNumber += 1;
        }
    }


    private function getMandatoryQuestions(array $settings): array
    {
        $questions = [];

        $mandatoryQuestions = $this->getAllQuestions()->where('category_id', '=', $settings['mandatoryCategory'])
            ->whereNotIn('id',
                $this->getHistoryQuestionsByCategory($settings['mandatoryCategory'])
                    ->pluck('question_id'))
            ->inRandomOrder()
            ->limit($settings['mandatoryQuestionsCount'])
            ->get()
            ->all();
        $questions = array_merge($mandatoryQuestions, $questions);

        if (count($mandatoryQuestions) < $settings['mandatoryQuestionsCount']) {
            $historyQuestions = $this->getHistoryQuestionsByCategory($settings['mandatoryCategory'])
                ->groupBy('question_id')
                ->inRandomOrder()
                ->limit($settings['mandatoryQuestionsCount'] - count($mandatoryQuestions))
                ->get()
                ->all();

            foreach ($historyQuestions as $question) {
                $questions = array_merge(Question::query()->where('id', '=', $question->id)->get()->all(), $questions);
            }
        }

        return $questions;
    }


    private function getQuestions(array $settings): array
    {
        $questions = [];

        $randomQuestion = $this->getAllQuestions()
            ->where('category_id','!=',$settings['mandatoryCategory'])
            ->whereNotIn('id',
                $this->getHistoryQuestions()
                    ->pluck('question_id'))
            ->inRandomOrder()
            ->limit($settings['questionsCount'] - $settings['mandatoryQuestionsCount'])
            ->get()
            ->all();
        $questions = array_merge($randomQuestion,$questions);

        if (count($randomQuestion) < $settings['questionsCount'] - $settings['mandatoryQuestionsCount']) {
            $historyQuestions = $this->getHistoryQuestionsByCategory($settings['mandatoryCategory'],"!=")
                ->groupBy('question_id')
                ->inRandomOrder()
                ->limit($settings['questionsCount'] - $settings['mandatoryQuestionsCount'] - count($randomQuestion))
                ->get()
                ->all();

            foreach ($historyQuestions as $question) {
                $questions = array_merge(Question::query()->where('id', '=', $question->id)->get()->all(), $questions);

            }
        }
        return $questions;

    }

    private function mergeQuestions(array $mandatoryQuestions, array $questions): array
    {
        return [
            'mandatoryQuestions' => $mandatoryQuestions,
            'questions' => $questions
        ];
    }

    private function getHistoryQuestionsByCategory(int $categoryId, string $operator = "="): Builder
    {
        return ExamQuestion::query()->whereIn('exam_id',Auth::user()->exams()->pluck('id')->toArray())
            ->leftJoin('questions','question_id','=','questions.id')
            ->where('category_id',$operator,$categoryId);
    }
    public function getHistoryQuestions(): Builder
    {
        return ExamQuestion::query()
            ->whereIn('exam_id',Auth::user()->exams()->pluck('id'))
            ->leftJoin('questions','question_id','=','questions.id');
    }

    private function getAnswers(array $questions): array
    {
        $questionsWithAnswers = [];
        foreach ($questions as $questionsKey=>$questionsValue)
        {
            foreach ($questionsValue as $question){
                $questionsWithAnswers[$question->id] = $question->answers()->get();
            }
        }
        return $questionsWithAnswers;
    }

    private function mixAnswers(array $questionsWithAnswers): array
    {
        $questionsWithMixedAnswers = [];
        foreach ($questionsWithAnswers as $questionKey => $questionValue){
            $shuffleAnswers = $questionValue->shuffle();
            $questionsWithMixedAnswers[$questionKey] = $shuffleAnswers;
        }
        return $questionsWithMixedAnswers;
    }

    private function getOrderAnswersJson(Collection $answers)
    {
        $parsedAnswers = [];
        $numberAnswer = 0;
        foreach($answers as $answer){
            $parsedAnswers[chr($numberAnswer+65)] = $answer->id;
            $numberAnswer += 1;
        }
        return json_encode($parsedAnswers);
    }

    private function getQuestionsWithAnswersArray(array $idQuestionsWithMixedAnswers): array
    {
        $questions = [];

        foreach ($idQuestionsWithMixedAnswers as $questionId => $answersObjects) {
            $questionObject = Question::query()->where('id','=',$questionId)->get()->first();
            $answers = [];
            foreach ($answersObjects as $answer) {
                $answers[] = [
                    'id' => $answer->id,
                    'value' => $answer->value,
                ];
            }
            $questions[] = [
                'id' => $questionObject->id,
                'value' => $questionObject->value,
                'image' => $questionObject->image,
                'category' => QuestionCategory::query()->find($questionObject->category_id)->name,
                'answers' => $answers,
            ];
        }

        return $questions;
    }

}

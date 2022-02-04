<?php

namespace App\Services;

use App\Models\Exam\Exam;
use App\Models\Exam\ExamStatistic;
use App\Models\Question\Question;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuestionService
{
    private ExamStatisticService $examStatisticService;

    public function __construct(ExamStatisticService $examStatisticService)
    {
        $this->examStatisticService = $examStatisticService;
    }

    public function startExam(array $settings, string $examId): array
    {
        $questions = $this->mergeQuestions($this->getMandatoryQuestions($settings),$this->getQuestions($settings));
        $this->addQuestionsForStatistic($questions, $examId);

        return $questions;
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

    private function addQuestionsForStatistic(array $mergedArray, string $examId): void
    {
        foreach ($mergedArray as $questions){
            foreach ($questions as $question){
                $stat = new ExamStatistic();
                $stat->user_id = Auth::user()->id;
                $stat->exam_id = $examId;
                $stat->question_id = $question['id'];
                $stat->save();
            }
        }
    }

    private function markCorrectQuestionForStatistic(array $questions): void
    {

    }

    private function getMandatoryQuestions(array $settings): array
    {
        $questions = [];

        $mandatoryQuestions = $this->getAllQuestions()->where('category_id', '=', $settings['mandatoryCategory'])
            ->whereNotIn('id',
                $this->examStatisticService->getQuestionsByCategory($settings['mandatoryCategory'])
                    ->pluck('question_id'))
            ->inRandomOrder()
            ->limit($settings['mandatoryQuestionsCount'])
            ->get()
            ->all();
        $questions = array_merge($mandatoryQuestions, $questions);

        if (count($mandatoryQuestions) < $settings['mandatoryQuestionsCount']) {
            $historyQuestions = $this->examStatisticService->getQuestionsByCategory($settings['mandatoryCategory'])
                ->groupBy('question_id')
                ->inRandomOrder()
                ->limit($settings['mandatoryQuestionsCount'] - count($mandatoryQuestions))
                ->get()
                ->all();

            foreach ($historyQuestions as $question) {
                $questions = array_merge(Question::query()->where('id', '=', $question->question_id)->get()->all(), $questions);

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
                $this->examStatisticService->getQuestions()
                    ->pluck('question_id'))
            ->inRandomOrder()
            ->limit($settings['questionsCount'] - $settings['mandatoryQuestionsCount'])
            ->get()
            ->all();
        $questions = array_merge($randomQuestion,$questions);

        if (count($randomQuestion) < $settings['questionsCount'] - $settings['mandatoryQuestionsCount']) {
            $historyQuestions = $this->examStatisticService->getQuestionsByCategory($settings['mandatoryCategory'],"!=")
                ->groupBy('question_id')
                ->inRandomOrder()
                ->limit($settings['questionsCount'] - $settings['mandatoryQuestionsCount'] - count($randomQuestion))
                ->get()
                ->all();

            foreach ($historyQuestions as $question) {
                $questions = array_merge(Question::query()->where('id', '=', $question->question_id)->get()->all(), $questions);

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

}

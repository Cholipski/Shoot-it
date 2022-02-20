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

    public function mergeQuestions(array $mandatoryQuestions, array $questions): array
    {
        return [
            'mandatoryQuestions' => $mandatoryQuestions,
            'questions' => $questions
        ];
    }

    public function getAllQuestions(): Builder
    {
        return Question::query()->where('is_delete', '=', 0);
    }

    public function getAnswers(array $questions): array
    {
        $questionsWithAnswers = [];
        foreach ($questions as $questionValue)
        {
            foreach ($questionValue as $question){
                $questionsWithAnswers[] = [
                    'question' => $question,
                    'answers' => $question->answers()->where('is_delete','=',0)->get(),
                ];
            }

        }
        return $questionsWithAnswers;
    }

    public function mixAnswers(array $questionsWithAnswers): array
    {
        $questionsWithMixedAnswers = [];
        foreach ($questionsWithAnswers as $questionValue){
            $shuffleAnswers = $questionValue['answers']->shuffle();
            $questionsWithMixedAnswers[] = [
                'question' => $questionValue['question'],
                'answers' => $shuffleAnswers
            ];
        }
        return $questionsWithMixedAnswers;
    }

    public function getOrderAnswersJson(Collection $answers): bool|string
    {
        $parsedAnswers = [];
        $numberAnswer = 0;
        foreach($answers as $answer){
            $parsedAnswers[chr($numberAnswer+65)] = $answer->id;
            $numberAnswer += 1;
        }
        return json_encode($parsedAnswers);
    }

    public function getQuestionsWithAnswersArray(array $idQuestionsWithMixedAnswers): array
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

    public function getHistoryQuestions(): Builder
    {
        return ExamQuestion::query()
            ->whereIn('exam_id',Auth::user()->exams()->pluck('id'))
            ->leftJoin('questions','question_id','=','questions.id');
    }

    public function getMandatoryQuestions(array $settings): array
    {
        $questions = [];

        $mandatoryQuestions = $this->getAllQuestions()->where('category_id', '=', $settings['mandatoryCategory'])
            ->whereNotIn('id',
                $this->getHistoryQuestionsByCategory($settings['mandatoryCategory'])
                    ->distinct()->pluck('question_id')->toArray())
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
                ->pluck('question_id');


            foreach ($historyQuestions as $question) {
                $questions = array_merge([Question::query()->where('id', '=', $question)->first()], $questions);
            }
        }
        return $questions;
    }


    public function getQuestions(array $settings): array
    {
        $questions = [];

        $randomQuestion = $this->getAllQuestions()
            ->where('category_id','!=',$settings['mandatoryCategory'])
            ->whereNotIn('id',
                $this->getHistoryQuestions()
                    ->distinct()->pluck('question_id')->toArray())
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
                ->pluck('question_id');
            foreach ($historyQuestions as $question) {
                $questions = array_merge([Question::query()->where('id', '=', $question)->first()], $questions);

            }
        }
        return $questions;

    }

    private function getHistoryQuestionsByCategory(int $categoryId, string $operator = "="): Builder
    {
        return ExamQuestion::query()->whereIn('exam_id',Auth::user()->exams()->pluck('id')->toArray())
            ->leftJoin('questions','question_id','=','questions.id')
            ->where('category_id',$operator,$categoryId);
    }


}

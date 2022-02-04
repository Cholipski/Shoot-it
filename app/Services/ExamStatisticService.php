<?php

namespace App\Services;

use App\Models\Exam\ExamStatistic;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class ExamStatisticService
{
    public function getQuestionsByCategory(int $categoryId, string $operator = "="): Builder
    {
        return ExamStatistic::query()->where('user_id','=',Auth::user()->id)
            ->leftJoin('questions','question_id','=','questions.id')
            ->where('category_id',$operator,$categoryId);
    }
    public function getQuestions(): Builder
    {
        return ExamStatistic::query()->where('user_id','=',Auth::user()->id)
            ->leftJoin('questions','question_id','=','questions.id');
    }

}

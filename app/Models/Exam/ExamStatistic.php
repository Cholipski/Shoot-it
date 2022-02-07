<?php

namespace App\Models\Exam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamStatistic extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'question_id',
        'exam_id',
        'correct_answer_id'
    ];
}

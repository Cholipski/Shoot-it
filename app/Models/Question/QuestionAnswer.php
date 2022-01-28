<?php

namespace App\Models\Question;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuestionAnswer extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'question_id',
        'value',
        'is_correct',
        'is_delete'
    ];

    public function Question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}

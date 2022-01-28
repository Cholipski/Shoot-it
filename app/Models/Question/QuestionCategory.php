<?php

namespace App\Models\Question;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuestionCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function Question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}

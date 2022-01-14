<?php

namespace App\Models\Question;

use App\Http\Controllers\Question\CategoryController;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Question extends Model
{
    use HasFactory, Uuids;

    /**
     * @var string[]
     */
    protected $fillable = [
        'value',
        'image'
    ];

    /**
     * @return HasOne
     */
    public function getCategory(): HasOne
    {
        return $this->hasOne(CategoryController::class);
    }

    public function getAnswers(): HasMany
    {
        return $this->hasMany(QuestionAnswer::class);
    }


}

<?php

namespace App\Models\Question;

use App\Http\Controllers\Question\CategoryController;
use App\Traits\Uuids;
use Database\Factories\QuestionFactory;
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
        'image',
        'is_delete',
        'category_id',
    ];

    /**
     * @return HasOne
     */
    public function category(): HasOne
    {
        return $this->hasOne(CategoryController::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(QuestionAnswer::class);
    }


    protected static function newFactory(): QuestionFactory
    {
        return QuestionFactory::new();
    }


}

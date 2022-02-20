<?php

namespace App\Models\Question;

use App\Http\Controllers\Question\CategoryController;
use App\Models\Settings\AppSettings;
use App\Traits\Uuids;
use Database\Factories\QuestionFactory;
use Illuminate\Database\Eloquent\Collection;
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

    public function getCorrectAnswer(): Collection
    {
        return $this->hasMany(QuestionAnswer::class)->where('is_correct','=',1)->get();
    }

    public function isMandatory(): bool
    {
        $setting = AppSettings::query()->where('key','=','exam')->first();
        $settingDecode = json_decode($setting->value, true);
        if($settingDecode['mandatoryCategory'] === $this->category_id)
            return true;
        else
            return false;
    }



    protected static function newFactory(): QuestionFactory
    {
        return QuestionFactory::new();
    }


}

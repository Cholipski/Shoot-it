<?php

namespace App\Models\Exam;

use App\Jobs\ExpireExam;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Exam extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'user_id',
        'is_active',
        'exam_number'
    ];

    public static function boot()
    {
        parent::boot();

        static::created(function(Exam $exam){
            ExpireExam::dispatch($exam)->delay(now()->addMinutes(20)->addSeconds(30));
        });
    }

    public function questions(): HasMany
    {
        return $this->hasMany(ExamQuestion::class);
    }
}

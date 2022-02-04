<?php

namespace App\Models\Exam;

use App\Jobs\ExpireExam;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'user_id',
        'is_active'
    ];

    public static function boot()
    {
        parent::boot();

        static::created(function(Exam $exam){
            ExpireExam::dispatch($exam)->delay(now()->addMinutes(20)->addSeconds(30));
        });
    }
}

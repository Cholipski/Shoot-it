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
        'exam_number',
        'score',
        'mandatory_mistake',
        'ended_at',
        'is_passed'
    ];

    public function questions(): HasMany
    {
        return $this->hasMany(ExamQuestion::class);
    }
}

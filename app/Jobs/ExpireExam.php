<?php

namespace App\Jobs;

use App\Models\Exam\Exam;
use App\Services\ExamService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExpireExam implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Exam $exam;
    private ExamService $examService;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Exam $exam, ExamService $examService)
    {
        $this->exam = $exam;
        $this->examService = $examService;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->examService->checkAnswers($this->exam->id);
        $this->exam->update([
            'is_active' => 0
        ]);
    }
}

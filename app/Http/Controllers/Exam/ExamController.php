<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use App\Jobs\ExpireExam;
use App\Models\Exam\Exam;
use App\Models\Exam\ExamQuestion;
use App\Models\Exam\ExamStatistic;
use App\Models\Question\Question;
use App\Models\Settings\AppSettings;
use App\Services\ExamService;
use App\Services\QuestionService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ExamController extends Controller
{
    private ExamService $examService;
    private array $settings;
    public function __construct(ExamService $examService)
    {
        $this->examService = $examService;
        $this->settings = json_decode(
            AppSettings::query()->where('key','=','exam')->first()->getSettings(),
            true);
    }

    public function index(){

        $exams = Exam::query()
            ->where('user_id','=',Auth::user()->id)
            ->orderBy('created_at','desc')
            ->paginate(6);

        return Inertia::render('Exam/Index',[
            'exams'=>$exams,
        ]);
    }

    public function selectAnswer(Request $request){

        $data = $request->all();
        ExamQuestion::query()->where('exam_id','=',$data['exam_id'])
            ->where('question_id','=',$data['question_id'])->update([
                'selected_answer' => $data['selected_answer_id']
            ]);
    }

    public function show($exam)
    {
        $exam = Exam::query()->where('id','=',$exam)->first();
        if($exam->is_active)
        {
            return Inertia::render('Exam/ExamActive',[
                    'Questions' => $this->examService->getQuestions($exam->id),
                    'Exam_id' => $exam->id,
                    'Ended_at' => $exam->ended_at,
                ]
            );
        }
        else
        {
            return Inertia::render('Exam/ExamEnded',[
                    'Questions' => $this->examService->getQuestions($exam->id, true),
                    'Exam_id' => $exam->id,
                    'is_passed' => $exam->is_passed
                ]
            );
        }


    }

    public function end(Request $request)
    {

        $this->examService->checkAnswers($request->exam_id);
        return redirect()->action(
            [ExamController::class, 'show'], ['exam' => $request->exam_id]
        );

    }

    public function create()
    {
        $examInProgress = Exam::query()
            ->where('user_id','=',Auth::user()->id)
            ->where('is_active','=',1)
            ->first();

        if($examInProgress != null){
            return redirect()->back()->with(['exam_in_progress'=> 1]);
        }
        else{
            $exam = Exam::create([
                'user_id' => Auth::user()->getAuthIdentifier(),
                'exam_number' => Exam::query()
                        ->where('user_id','=',Auth::user()->getAuthIdentifier())
                        ->orderBy('created_at', 'desc')
                        ->first() ? Exam::query()
                        ->where('user_id','=',Auth::user()->getAuthIdentifier())
                        ->orderBy('created_at', 'desc')
                        ->first()->exam_number + 1 : 1,
            ]);

            $this->examService->startExam($this->settings, $exam->id);

            ExpireExam::dispatch($exam, $this->examService)->delay(now()->addMinutes(20)->addSeconds(0));

            $exam->update([
                'ended_at' => now()->addMinutes(20)->addSeconds(2),
            ]);

            return redirect()->action(
                [ExamController::class, 'show'], ['exam' => $exam->id]
            );

        }
    }
}

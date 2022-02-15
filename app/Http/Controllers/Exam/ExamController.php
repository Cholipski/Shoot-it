<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use App\Models\Exam\Exam;
use App\Models\Exam\ExamStatistic;
use App\Models\Question\Question;
use App\Models\Settings\AppSettings;
use App\Services\QuestionService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ExamController extends Controller
{
    private QuestionService $questionService;
    private array $settings;
    public function __construct(QuestionService $questionService)
    {
        $this->questionService = $questionService;
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

    public function create()
    {
//        $examInProgress = Exam::query()
//            ->where('user_id','=',Auth::user()->id)
//            ->where('is_active','=',1)
//            ->first();
//
//        if($examInProgress != null){
//            return redirect()->back()->with(['message'=> ["examInProgress"=>1]]);
//        }
//        else{
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

            
            return Inertia::render('Exam/Exam',[
                'Questions' => $this->questionService->startExam($this->settings, $exam->id)
            ]);
        }
//    }
}

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
        return Inertia::render('Exam/Index');
    }

    public function create()
    {
        return redirect()->back()->with(['message'=> ["examInProgress"=>1]]);
//        $last_exam = Exam::query()->where('user_id','=',Auth::user()->id)->orderBy('created_at')->first();
//        if(Carbon::now()->diffInSeconds($last_exam->created_at->format('Y-m-d H:i:s')) > 300){
//            $exam = Exam::create([
//                'user_id' => Auth::user()->getAuthIdentifier(),
//            ]);
//        }


//        dd($this->questionService->startExam($this->settings, $exam->id));
    }
}

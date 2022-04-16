<?php

namespace App\Http\Controllers\Learning;

use App\Http\Controllers\Controller;
use App\Models\Learning\Learning;
use App\Models\Question\Question;
use App\Models\Question\QuestionCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class LearningController extends Controller
{
    public function index()
    {
        $progressObject = Learning::where('user_id','=',Auth::user()->getAuthIdentifier())->first();
        $numberAnsweredQuestion = 0;
        $progress = null;
        if($progressObject != null)
        {
            $progress = json_decode($progressObject->progress, true);
            foreach ($progress as $value){
                $numberAnsweredQuestion += $value;
            }
        }

        $questionCount = [];
        $numbersQuestions = Question::all()->groupBy('category_id');
        foreach ($numbersQuestions as $key=>$value)
        {
            $questionCount[$key] = $value->count();
        }

        $assignedCategories = Question::all()->groupBy('category_id')->keys()->toArray();

        return Inertia::render('Learning/Index',[
            'categories' => QuestionCategory::whereIn('id',$assignedCategories)->get(),
            'NumberQuestions' => Question::all()->count(),
            'NumberAnsweredQuestion' => $numberAnsweredQuestion,
            'progress' => $progress,
            'questionCount' => $questionCount,
        ]);
    }

    public function show($id)
    {
        $progressObject = Learning::where('user_id','=',Auth::user()->getAuthIdentifier())->first();


        if($progressObject === null)
        {
            $progressArray = [];
            $progressArray[$id] = 0;
            Learning::create([
                'user_id' => Auth::user()->getAuthIdentifier(),
                'progress' => json_encode($progressArray),
            ]);
            $progressObject = Learning::where('user_id','=',Auth::user()->getAuthIdentifier())->first();
        }
        $progress = json_decode($progressObject->progress, true);
        if(!array_key_exists($id,$progress))
        {
            $progress[$id] = 0;
            $progressObject->update([
                'progress' => json_encode($progress),
            ]);
        }
        $question =  Question::where('category_id','=',$id)->orderBy('created_at','ASC')->get()->values()->get($progress[$id]);
        return Inertia::render('Learning/Learning',[
            'question' => $question,
            'correctAnswer' => $question->getCorrectAnswer(),
            'answers' => $question->answers()->get()
        ]);
    }

    public function update(Request $request, $id)
    {
        $progressObject = Learning::where('user_id','=',Auth::user()->getAuthIdentifier())->first();
        $progress = json_decode($progressObject->progress, true);
        $progress[$id] += 1;
        $progressObject->update([
            'progress' => json_encode($progress),
        ]);
        return Redirect::route('learning.show',$id);
    }

    public function destroy($id){
        Learning::query()->where('user_id','=',$id)->delete();
        return Redirect::route('learning.index')->with(['message'=>'Pomyślnie zresetowano postępy']);

    }
}

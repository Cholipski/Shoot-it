<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Http\Requests\Question\QuestionRequest;
use App\Http\Resources\QuestionCollection;
use App\Http\Resources\QuestionResource;
use App\Http\Resources\QuestionShowResource;
use App\Models\Question\Question;
use App\Models\Question\QuestionAnswer;
use App\Models\Question\QuestionCategory;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;


class QuestionController extends Controller
{
    public function index(): Response
    {
        request()->validate([
            'direction' => ['in:asc,desc'],
            'field'=>['in:value,category']
        ]);

        $query = Question::query()->where('is_delete','=',0);

        if(request('search')){
            $query->where('value','LIKE','%'.request('search').'%');
        }

        if(request()->has(['field','direction'])){
            $query->orderBy(request('field'),request('direction'));
        }

        return Inertia::render('Question/List',[
            'questions'=>new QuestionCollection($query->Paginate(7)),
            'filters' => request()->all(['search','field','direction'])
        ]);
    }

    public function edit(Question $question)
    {
        return Inertia::render('Question/Edit',[
            'question' => $question,
            'answers' => $question->answers()->where('is_delete','=',0)->get(),
            'categories' => QuestionCategory::all(),
        ]);
    }

    public function update(QuestionRequest $request, Question $question): RedirectResponse
    {
        //dd($request, $question);
        //abort_if(!Auth::user()->can('update question'),401,'Unauthorized');

        try{
            DB::transaction(function () use ($request,$question) {
                $question->update([
                    'value'=>$request->value,
                    'category_id'=>$request->category,
                ]);

                foreach ($request->answers as $answer){
                    if(isset($answer['id'])){
                        QuestionAnswer::where('id','=',$answer['id'])->update([
                            'value' => $answer['answer'],
                            'is_correct' => $answer['is_correct'],
                            'is_delete' => $answer['deleted'],
                        ]);
                    }else{
                        QuestionAnswer::create([
                            'value' => $answer['answer'],
                            'question_id' => $question->id,
                            'is_correct' => $answer['is_correct'],
                        ]);
                    }
                }

            });

            return Redirect::route('question.edit', $question)->with([
                    'message'=>'Question update successfully',
                ]);
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors([
                'update' => 'Ups, something goes wrong'
            ]);
        }
    }

    public function create(): Response
    {
        return Inertia::render('Question/Create',[
            'categories' => QuestionCategory::all()
        ]);
    }

    public function store(QuestionRequest $request): RedirectResponse
    {
//        abort_if(!Auth::user()->can('create question'),401,'Unauthorized');
        try{
            DB::transaction(function () use ($request) {
                $question = Question::query()->create(
                    [
                        'value' => $request->value,
                        'category_id' => $request->category,
                    ]
                );

                foreach ($request->answers as $value){
                    QuestionAnswer::query()->create([
                        'question_id' => $question->id,
                        'value' => $value['answer'],
                        'is_correct' => $value['is_correct'],
                    ]);
                }

            });

            return Redirect::route('question.index')->with(['message'=>'Question create successfully']);

        }
        catch(\Exception $e){
            return Redirect::route('question.index')->withErrors([
                'create' => 'Ups, something goes wrong'
            ]);
        }

    }

    public function show(Question $question){

//        abort_if(!Auth::user()->can('show question'),401,'Unauthorized');

        return Inertia::render('Question/Show',['data' =>new QuestionShowResource($question)]);
    }

    public function destroy(Question $question)
    {
//        abort_if(!Auth::user()->can('delete question'),401,'Unauthorized');

        try{
            $question->update([
                'is_delete' => 1
            ]);
            return Redirect::route('question.index')->with([
                'message' => 'Question delete successfully'
            ]);
        }
        catch(Exception $e){
            return Redirect::back()->withErrors(['delete'=>'Ups, something goes wrong']);
        }

    }

}

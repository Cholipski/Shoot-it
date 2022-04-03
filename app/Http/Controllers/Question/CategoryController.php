<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Question\QuestionCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index()
    {
        return Inertia::render('QuestionCategories/Index', [
            'categories' => QuestionCategory::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'short_name' => 'required',
            'description' => 'required'
        ]);

        QuestionCategory::create([
            'name' => $request->name,
            'short_name'=> $request->short_name,
            'description' => $request->description
        ]);

        return back()->with([
            'message'=>'Nowa kategoria została pomyślnie utworzona',
        ]);
    }

    public function edit($id)
    {
        return Inertia::render('QuestionCategories/Edit', [
            'categories' => QuestionCategory::all(),
            'selected_category' => QuestionCategory::find($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'short_name' => 'required',
            'description' => 'required'
        ]);

        QuestionCategory::find($id)->update([
            'name' => $request->name,
            'short_name'=> $request->short_name,
            'description' => $request->description
        ]);

        return back()->with([
            'message'=>'Kategoria została pomyślnie zaktualizowana',
        ]);
    }

    public function destroy($id)
    {
        QuestionCategory::find($id)->delete();
        return Redirect::route('categories.questions.index')->with([
            'message'=>'Kategoria została pomyślnie usunięta',
        ]);
    }
}

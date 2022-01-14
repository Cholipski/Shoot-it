<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionCollection;
use App\Models\Question\Question;
use Inertia\Inertia;
use Inertia\Response;


class QuestionController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Question/List',['questions'=>new QuestionCollection(Question::all())]);
    }

    public function update()
    {
        // update method
    }

    public function create()
    {
        // create method
    }

    public function delete()
    {
        //delete method
    }

}

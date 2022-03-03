<?php

namespace App\Http\Controllers\Learning;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LearningController extends Controller
{
    public function index()
    {
        return Inertia::render('Learning/Index');
    }
}

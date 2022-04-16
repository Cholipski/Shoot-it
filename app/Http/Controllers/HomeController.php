<?php

namespace App\Http\Controllers;

use App\Models\Exam\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index(){

        $failedExams = Exam::query()->where('is_active','=',0)
            ->where('user_id','=',Auth::user()->id)
            ->where('is_passed','=',0)->count();

        $passedExams = Exam::query()->where('is_active','=',0)
            ->where('user_id','=',Auth::user()->id)
            ->where('is_passed','=',1)->count();

        $exams = Exam::query()
            ->where('user_id','=',Auth::user()->id)
            ->where('is_active','=',0)
            ->orderBy('created_at','desc')
            ->limit(5)->get();

        $examsWeek = Exam::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->get()
            ->groupBy(function($val) {
                return Carbon::parse($val->created_at)->format('N');
            });

        return Inertia::render('Dashboard',[
            'examPassed' => $passedExams,
            'examFailed' => $failedExams,
            'lastExams' => $exams,
            'weekExams' => $examsWeek
        ]);
    }
}

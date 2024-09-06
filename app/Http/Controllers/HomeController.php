<?php

namespace App\Http\Controllers;

use App\Models\Certification;
use App\Models\Exam;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Method index
     *
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    public function allExams()
    {
        return view('frontend.exams.index');
    }

    public function viewExam($id)
    {
        $certification = Certification::find($id);

        return view('frontend.exams.show', compact('certification'));
    }

    public function allProviders()
    {
        $exams = Exam::all();

        return view('frontend.providers.index', compact('exams'));
    }

    public function viewProvider($id)
    {
        $exam = Exam::find($id);

        return view('frontend.providers.view', compact('exam'));
    }
}

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

    public function viewExam($id)
    {
        $certification = Certification::find($id);

        return view('exams.show', compact('certification'));
    }

    public function allProviders()
    {
        $exams = Exam::all();

        return view('providers.index', compact('exams'));
    }

    public function viewProvider($id)
    {
        $exam = Exam::find($id);

        return view('providers.view', compact('exam'));
    }
}

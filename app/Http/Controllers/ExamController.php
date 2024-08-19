<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Method index exams
     *
     */
    public function index()
    {
        $exams = Exam::all();

        return view('admin.exams.index', compact('exams'));
    }

    /**
     * Method create exams
     *
     */
    public function create()
    {
        return view('admin.exams.create');
    }

    /**
     * Method show
     *
     */
    public function show($id)
    {
        $exam = Exam::find($id);

        return view('admin.exams.show', compact('exam'));
    }
}

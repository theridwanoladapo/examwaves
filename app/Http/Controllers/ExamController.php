<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Method index
     *
     */
    public function index()
    {
        $exams = Exam::all();

        return view('admin.exams.index', compact('exams'));
    }
    
    /**
     * Method create
     *
     */
    public function create()
    {
        return view('admin.exams.create');
    }
}

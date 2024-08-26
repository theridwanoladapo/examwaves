<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Method create
     *
     */
    public function create()
    {
        return view('admin.questions.create');
    }
    /**
     * Method upload
     *
     */
    public function upload()
    {
        return view('admin.questions.upload');
    }
}

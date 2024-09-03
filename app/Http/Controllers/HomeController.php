<?php

namespace App\Http\Controllers;

use App\Models\Certification;
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
}

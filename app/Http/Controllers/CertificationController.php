<?php

namespace App\Http\Controllers;

use App\Models\Certification;
use App\Models\Exam;
use Illuminate\Http\Request;

class CertificationController extends Controller
{    
    /**
     * Method index
     *
     */
    public function index()
    {
        $certifications = Certification::all();

        return view('admin.certifications.index', compact('certifications'));
    }
    
    /**
     * Method create
     *
     */
    public function create()
    {
        $exams = Exam::all();

        return view('admin.certifications.create', compact('exams'));
    }
    
    /**
     * Method show
     *
     * @param $id $id [explicite description]
     *
     */
    public function show($id)
    {
        $certification = Certification::find($id);

        return view('admin.certifications.show', compact('certification'));
    }
}

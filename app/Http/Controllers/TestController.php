<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    
    /**
     * All tests list page
     *
     */
    public function index()
    {
        return view('admin.tests.index');
    }
        
    /**
     * Create test page
     *
     */
    public function create()
    {
        return view('admin.tests.create');
    }

    /**
     * View single test page
     *
     * @param $id $id
     *
     */
    public function show($id)
    {
        $test = Test::find($id);

        return view('admin.tests.show', compact('test'));
    }
    
    /**
     *Go to quiz page
     *
     * @param $id $id
     *
     */
    public function tryQuiz($id)
    {
        $test = Test::find($id);

        return view('admin.tests.quiz', compact('test'));
    }
}

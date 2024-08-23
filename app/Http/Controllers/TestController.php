<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    
    /**
     * Method index
     *
     */
    public function index()
    {
        return view('admin.tests.index');
    }
        
    /**
     * Method create
     *
     */
    public function create()
    {
        return view('admin.tests.create');
    }

    /**
     * Method show
     *
     * @param $id $id
     *
     */
    public function show($id)
    {
        $test = Test::find($id);

        return view('admin.tests.show', compact('test'));
    }
}

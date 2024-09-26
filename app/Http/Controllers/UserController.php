<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Method index
     *
     */
    public function index()
    {
        return view('admin.users.index');
    }

    /**
     * Method show
     *
     * @param $id $id [explicite description]
     *
     */
    public function show($id)
    {
        return view('admin.users.index');
    }
}

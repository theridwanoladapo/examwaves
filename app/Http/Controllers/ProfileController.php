<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * View profile page
     *
     */
    public function profile()
    {
        return view('user.profile');
    }

    /**
     * View settings page
     *
     */
    public function settings()
    {
        return view('user.settings');
    }

    /**
     * View exam page
     *
     * @param $id $id
     *
     */
    public function exam($id)
    {
        $certification = \App\Models\Certification::find($id);

        return view('user.exam', compact('certification'));
    }

    /**
     *  Go to quiz page
     *
     * @param $id $id
     *
     */
    public function tryQuiz($id, $test_id)
    {
        $test = Test::find($test_id);

        return view('user.take-quiz', compact('test'));
    }
}

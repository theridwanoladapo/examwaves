<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\UserProfile;
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

    public function profileEdit()
    {
        // $user_profile = UserProfile::where('user_id', auth()->user()->id);

        return view('user.profile-edit');
    }

    /**
     * View settings page
     *
     */
    public function settings()
    {
        return view('user.settings');
    }

    public function exams()
    {
        return view('user.exams');
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
     * @param  $id
     *
     */
    public function tryQuiz($id, $test_id)
    {
        $tests = Test::where('certification_id', $id)->get();
        $test = Test::find($test_id);

        return view('user.take-quiz', compact('test', 'tests'));
    }
}

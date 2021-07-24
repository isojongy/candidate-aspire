<?php

namespace App\Http\Controllers;

use UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use CommonHelper;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->userService = app()->make(UserService::class);
    }

    /**
     * Show the application dashboard.
     *
     */
    public function index()
    {
        $user = \Auth::user();
        if ($user->isManager()) {
            $users = $this->userService->getStaffList($user->id);
            View::share('users', $users);
        }
        return view('home');
    }
}

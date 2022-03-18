<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()->level == 1) {
            $data['title'] = 'Users Setting';
            $data['user'] = Auth::user();
            return view('user.index', $data);
            // dd($data);
        } else {
            return redirect('/');
        }
    }
}

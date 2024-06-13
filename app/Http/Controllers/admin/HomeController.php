<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index() {

        return view('admin.dashboard');

        // $admin = Auth :: guard('admin')->user();

        // echo 'welcome' .$admin -> name.' <a href="'.route('admin.logout').'"> LOgout</a>' ;
    }

    public function logout() {

        Session::flush();

        Auth::guard('admin')->logout();

        return redirect()->route('admin.login');
    }
}

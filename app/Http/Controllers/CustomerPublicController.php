<?php

namespace App\Http\Controllers;



use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CustomerPublicController;



class CustomerPublicController extends Controller
{
    public function index() {
        return view('customer.login');

    }

   

}

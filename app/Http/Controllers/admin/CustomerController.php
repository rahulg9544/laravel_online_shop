<?php

namespace App\Http\Controllers\admin;



use view;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;



class CustomerController extends Controller
{
    public function index() {
        $customers = User::latest()->paginate(10);

        return view('admin.customer.list', compact('customers'));

    }

    public function cust_list() {
     

        return view('login');

    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'

        ]);

        if($validator->passes()) {

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;

            $user->password = Hash::$request->password;
    
            $user->save();


            $request->session()->flash('success','customer Added successfully');

            return response()->json([
                'status' => true,
                'message' => 'user Added successfully'
            ]);
            
            

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

   

}

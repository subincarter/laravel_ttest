<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function loginCustomer(Request $req)
    {
        $customer =  Customers::where('email', $req['email'])->get();
        if (count($customer) > 0) {
            session(['id' => $customer[0]->id]);
            // return session('id');
            return redirect()->route('products'); 
        }
        else{
            return 'customer not found';
        }
    }
}

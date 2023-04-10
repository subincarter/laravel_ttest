<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Products;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Products::get()->toArray();
        return view('home', ['data' => $products]);
    }

    public function whislistPage()
    {
        $products =  Orders::with('products')->where('customer_id', session('id'))->
        where('payment',0)->get()->toArray();
        return view('order', ['data' => $products]);
    }
}

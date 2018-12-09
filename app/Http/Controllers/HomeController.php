<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();
        return view('channel.index',[
            'all_product' => $product,
        ]);
    }


    /**
     * show list product
     *  @return \Illuminate\Http\Response
     */
    public function getListProduct()
    {
        $list_product = Product::paginate(3);
        return view('channel.pages.products',[
            'list_product' => $list_product,
        ]);
    }
}

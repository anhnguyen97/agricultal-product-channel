<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Product;

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
        $trader_id_list = User::select('id')->where('is_farmer', 0)->get();
        $all_product = Product::where('delete', 0)->whereNotIn('farmer_id', $trader_id_list)->paginate(12);
        foreach ($all_product as $key => $product) {
            if (strlen($product->description)>=80) {
                $pos=strpos($product->description, ' ', 80);
                $product['description'] = substr($product->description,0,$pos); 
            }
            $product['farmer_name'] = $product->user->name;
        }
        return view('channel.index',[
            'list_product' => $all_product,
        ]);
    }

    public function product_detail($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $product['farmer'] = $product->user;
        $product['farmer_contact'] = $product->user->contact;
        // dd($product);
        return view('channel.pages.product_detail', [
            'product' => $product,
        ]);
    }
}

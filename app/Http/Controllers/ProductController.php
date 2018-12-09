<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['farmer_id'] = Auth::user()->id;
        $data['slug'] = str_slug($request->name).md5($data['farmer_id']);
        $data['delete'] = 0;        
        $date = date('YmdHis', time());
        if ($request->hasFile('thumbnail')) {
            $extension = '.'.$data['thumbnail']->getClientOriginalExtension();
            $file_name = md5($request->name).'_'. $date . $extension;
            $data['thumbnail']->storeAs('public/products/',$file_name);
            $data['thumbnail'] = 'storage/products/'.$file_name;
        } 
        $product = Product::create($data);
        if ($product) {
            $product['category_name'] = $product->category->name;
        }
        return $product;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::where('id',$id)->first();
        $product['category_name'] = $product->category->name;
        return $product;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        // $product->category_name = $product->category->name;
        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $data = $request->all();

        $data['slug'] = str_slug($request->name).'-'.md5($product->farmer_id); 

        $date = date('YmdHis', time());
        if ($request->hasFile('thumbnail')) {
            $extension = '.'.$data['thumbnail']->getClientOriginalExtension();
            $file_name = md5($request->name).'_'. $date . $extension;

            //xóa thumbnail cũ
            $file = explode('/',$product->thumbnail)[2];
            Storage::delete($file);
            unlink(storage_path('app/public/products/'.$file));

            //update new thumbnail
            $data['thumbnail']->storeAs('public/products/',$file_name);
            $data['thumbnail'] = 'storage/products/'.$file_name;
        } 
        $product = Product::find($id)->update($data);
        if ($product == true ) {
            $product = Product::find($id);
            $product['category_name'] = $product->category->name;
        }
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res =  Product::where('id',$id)->update([
            'delete' => 1,
        ]);
        if ($res) {     
            return response()->json('success');
        } else {
            return response([],400);
        }        
    }

    public function updateDb()
    {
        $list = Product::all();
        foreach ($list as $key => $item) {
            $date = date('YmdHis', time());
            // $extension = '.'.explode('.',$item->thumbnail);
            $extension = '.jpg';
            $file_name = md5($item->name.$item->farmer_id).'_'. $date . $extension;
            $path = 'storage/products/'.$file_name;
            // dd($item->name);
            // dd(str_slug($item->name,'-'));
            $abc= str_slug($item->name,'-'). '.jpg';
            // dd($abc);
            Storage::move('public/products/'.$abc, 'public/products/'.$file_name);
            $data = array(
                'slug' => str_slug($item->name),
                'thumbnail' => $path,
                'quantity' => rand(0,259),
            );
            Product::find($item['id'])->update($data);
        }
    }

    //FARMER
    /**
     * show product management page
     * @return [type] [description]
     */
    public function farmerProduct()
    {
        return view('farmer_trader.farmer.product.index');
    }

    public function farmerGetProduct()
    {
        $farmer_id = Auth::user()->id;
        $listProduct = Product::where([
            ['farmer_id','=',$farmer_id],
            ['delete', '=', 0],
        ])->get();
        return Datatables::of($listProduct)
        ->addColumn('action', function ($product) {
            return '<a title="Detail" class="btn btn-info btn-sm fa fa-eye btnShow" data-id="'.$product["id"].'" id="row-'.$product["id"].'"></a>&nbsp;<a title="Edit" class="btn btn-warning btn-sm fa fa-pencil btnEdit" data-id='.$product["id"].'></a>&nbsp;<a title="Delete" class="btn btn-danger btn-sm fa fa-trash-o btnDelete" data-id='.$product["id"].'></a>';
        })
        ->editColumn('updated_at', function($product){
            return $product->updated_at->format('H:i:s d/m/Y');
        })
        ->editColumn('category', function($product){
            $category = $product->category;
            return $category->name;
        })
        ->editColumn('quantity', function($product){
            return number_format($product->quantity);
        })
        ->editColumn('price', function($product){
            return number_format($product->price, 2);
        })
        ->setRowId(function ($product) {
            return 'row-'.$product->id;
        })
        ->make(true);
    }

    //TRADER
    /**
     * show product management page
     * @return [type] [description]
     */
    public function traderProduct()
    {
        return view('farmer_trader.trader.product.index');
    }

    public function traderGetProduct()
    {
        $trader_id = Auth::user()->id;
        $listProduct = Product::where([
            ['farmer_id','=',$trader_id],
            ['delete', '=', 0],
        ])->get();
        return Datatables::of($listProduct)
        ->addColumn('action', function ($product) {
            return '<a title="Detail" class="btn btn-info btn-sm fa fa-eye btnShow" data-id="'.$product["id"].'" id="row-'.$product["id"].'"></a>&nbsp;<a title="Edit" class="btn btn-warning btn-sm fa fa-pencil btnEdit" data-id='.$product["id"].'></a>&nbsp;<a title="Delete" class="btn btn-danger btn-sm fa fa-trash-o btnDelete" data-id='.$product["id"].'></a>';
        })
        ->editColumn('updated_at', function($product){
            return $product->updated_at->format('H:i:s d/m/Y');
        })
        ->editColumn('category', function($product){
            $category = $product->category;
            return $category->name;
        })
        ->editColumn('quantity', function($product){
            return number_format($product->quantity);
        })
        ->editColumn('price', function($product){
            return number_format($product->price, 2);
        })
        ->setRowId(function ($product) {
            return 'row-'.$product->id;
        })
        ->make(true);
    }

}

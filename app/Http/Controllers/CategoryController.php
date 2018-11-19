<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\User;
use App\Product;
use Yajra\Datatables\Datatables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.category.index');
    }

    /*
    get data ajax with Datatables
     */
    public function getData()
    {
        return Datatables::of(Category::query())
        ->addColumn('action', function ($category) {
            return '<a title="List product" href="http://dss.me/admin/category/'.$category['slug'].'" class="btn btn-info btn-sm glyphicon glyphicon-list-alt btnShow" data-id="'.$category["id"].'"></a>&nbsp;<a title="Edit" class="btn btn-warning btn-sm glyphicon glyphicon-edit btnEdit" data-id='.$category["id"].'></a>&nbsp;<a title="Delete" class="btn btn-danger btn-sm glyphicon glyphicon-trash btnDelete" data-id='.$category["id"].'></a>';
        })
        ->editColumn('updated_at', function($category){
            return $category->updated_at->format('H:i:s d/m/Y');
        })
        ->editColumn('created_at', function($category){
            return $category->created_at->format('H:i:s d/m/Y');
        })
        ->setRowId(function ($category) {
            return 'row-'.$category->id;
        })
        ->make(true);
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
        $data['slug'] = str_slug($data['name'],'-');
        // dd($data);
        return Category::create($data);
    }

    /**
     * Display view list product group by category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function listProduct($category_slug)
    {
        return view('admins.category.listProduct')->with('category_slug', $category_slug);       
    }

    /**
     * get data List product filter by Category with ajax
     * @param  [type] $category_slug [description]
     * @return [type]             [description]
     */
    public function getDataListProduct($category_slug)
    {
        $category = Category::where('slug','=',$category_slug)->first();
        $listProduct = $category->products()->get();
        // dd($category_id);
        return Datatables::of($listProduct)
        ->addColumn('action', function ($product) {
            return '<a title="Detail" class="btn btn-info btn-sm glyphicon glyphicon-eye-open btnShow" data-id="'.$product["id"].'"></a>&nbsp;<a title="Edit" class="btn btn-warning btn-sm glyphicon glyphicon-edit btnEdit" data-id='.$product["id"].'></a>&nbsp;<a title="Delete" class="btn btn-danger btn-sm glyphicon glyphicon-trash btnDelete" data-id='.$product["id"].'></a>';
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
        ->editColumn('cost', function($product){
            return number_format($product->cost, 2);
        })
        ->setRowId(function ($product) {
            return 'row-'.$product->id;
        })
        ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Category::find($id);
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
        $data = $request->all();
        // console.log($data);
        $res = Category::find($id)->update($data);
        if($res == true){
            return Category::find($id);
        } else {
            return response([],400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($id)
    {
        $productInCategory = Product::where('category_id', '=', $id)->exists();

        if ($productInCategory==true) {
            return response()->json('existProduct', 200);
        } else {
            return Category::find($id)->delete()?response()->json('success'):response([],400);
        }
    }
}

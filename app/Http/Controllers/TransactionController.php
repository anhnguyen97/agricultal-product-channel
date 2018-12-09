<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\User;
use App\Contact;
use App\Product;
use App\TransactionDetail;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function farmerIndex()
    {
        return view('farmer_trader.farmer.transaction.index');
    }

    public function farmerGetTransaction()
    {
        $farmerID = Auth::id();
        $trans_list = Transaction::where([['farmer_id', $farmerID],['farmer_delete',0]])->get();
        return Datatables::of($trans_list)
        ->addColumn('action', function ($transaction) {
            return '<a title="Detail" href="http://agri.me/farmer/transaction/'.$transaction['id'].'" class="btn btn-info btn-sm fa fa-eye btnShow" data-id="'.$transaction["id"].'" id="row-'.$transaction["id"].'"></a>&nbsp;<a title="Update" class="btn btn-warning btn-sm fa fa-pencil btnUpdate" data-id='.$transaction["id"].'></a>&nbsp;<a title="Delete" class="btn btn-danger btn-sm fa fa-trash-o btnDelete" data-id='.$transaction["id"].'></a>';
        })
        ->editColumn('trader_id', function($transaction){ 
            $trader = User::find($transaction->trader_id);
            return $trader->name;
        })
        ->editColumn('created_at', function($transaction){
            return $transaction->created_at->format('H:i:s d/m/Y');
        })
        ->editColumn('updated_at', function($transaction){
            return $transaction->updated_at->format('H:i:s d/m/Y');
        })
        ->editColumn('total', function($transaction){
            return number_format($transaction->total, 2);
        })
        ->setRowId(function ($transaction) {
            return 'row-'.$transaction->id;
        })
        ->make(true);
    }

    public function farmerTranDetail($id)
    {
        $trans_info = Transaction::where('id',$id)->first();
        $trader = User::find($trans_info->trader_id)->first();
        $receiver = Contact::where('id', $trans_info->contact_id)->first();
        return view('farmer_trader.farmer.transaction.detail',[
            'trader'=> $trader,
            'receiver' => $receiver,
            'trans_info' => $trans_info,
        ]);
    }

    public function farmerGetTranDetail($tran_id)
    {
        $list_product = TransactionDetail::where('transaction_id', $tran_id)->get();

        return Datatables::of($list_product)
        ->addColumn('thumbnail', function($product){
            return $product->products->thumbnail;
        })
        ->addColumn('unit', function($product){ 
            return $product->products->unit;
        })
        ->addColumn('product_name', function($product){
            return $product->products->name;
        })
        ->addColumn('sum', function($product){
            return number_format($product->price*$product->quantity*(100-$product->discount)/100, 2)." VNĐ";
        })
        ->editColumn('price', function($product){
            return number_format($product->price, 2);
        })
        ->editColumn('discount', function($product){
            return number_format($product->discount, 2)." %";
        })
        ->setRowId(function ($product) {
            return 'row-'.$product->id;
        })
        ->make(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function farmerDestroy($id)
    {
        $transaction = Transaction::find($id);
        if ($transaction->status == 1 ) {
            return Transaction::where('id', $id)->update(['farmer_delete' => 1]);
        } 
        return response()->json([],200);        
    }

    /**
     * TRADER
     * @return [type] [description]
     */
    // trader load trang quản lý giao dịch nhập hàng/ nông sản
    public function traderImport()
    {
        return view('farmer_trader.trader.transaction.import');
    }

    public function traderGetTranImport()
    {
        $trader_id = Auth::id();
        $trans_list = Transaction::where([['trader_id', $trader_id],['trader_delete',0], ['typeTran', 0]])->get();
        return Datatables::of($trans_list)
        ->addColumn('action', function ($transaction) {
            return '<a title="Detail" href="http://agri.me/trader/transaction/import/'.$transaction['id'].'" class="btn btn-info btn-sm fa fa-eye btnShow" data-id="'.$transaction["id"].'" id="row-'.$transaction["id"].'"></a>&nbsp;<a title="Update" class="btn btn-warning btn-sm fa fa-pencil btnUpdate" data-id='.$transaction["id"].'></a>&nbsp;<a title="Delete" class="btn btn-danger btn-sm fa fa-trash-o btnDelete" data-id='.$transaction["id"].'></a>';
        })
        ->editColumn('farmer_id', function($transaction){ 
            $farmer = User::find($transaction->farmer_id);
            return $farmer->name;
        })
        ->editColumn('payment', function($transaction){
            return $transaction->payment==1?"Đã thanh toán":"Chưa thanh toán";
        })
        ->editColumn('status', function($transaction){
            return $transaction->status==1?"Đã hoàn thành":"Chưa xử lý";
        })
        ->editColumn('created_at', function($transaction){
            return $transaction->created_at->format('H:i:s d/m/Y');
        })
        ->editColumn('updated_at', function($transaction){
            return $transaction->updated_at->format('H:i:s d/m/Y');
        })
        ->editColumn('total', function($transaction){
            return number_format($transaction->total, 2);
        })
        ->setRowId(function ($transaction) {
            return 'row-'.$transaction->id;
        })
        ->make(true);
    }

    //trader delete transaction
    public function traderDestroy($id)
    {
        $transaction = Transaction::find($id);
        if ($transaction->status == 1 ) {
            return Transaction::where('id', $id)->update(['trader_delete' => 1]);
        } 
        return response()->json([],200);        
    }

    //trader loading transaction - export - load trang quản lý giao dịch xuất hàng
    public function traderExport()
    {
        return view('farmer_trader.trader.transaction.export');
    }

    public function traderGetTranExport()
    {
        $trader_id = Auth::id();
        $trans_list = Transaction::where([['trader_id', $trader_id],['trader_delete',0], ['typeTran', 1]])->get();
        return Datatables::of($trans_list)
        ->addColumn('action', function ($transaction) {
            return '<a title="Detail" href="http://agri.me/trader/transaction/export/'.$transaction['id'].'" class="btn btn-info btn-sm fa fa-eye btnShow" data-id="'.$transaction["id"].'" id="row-'.$transaction["id"].'"></a>&nbsp;<a title="Update" class="btn btn-warning btn-sm fa fa-pencil btnUpdate" data-id='.$transaction["id"].'></a>&nbsp;<a title="Delete" class="btn btn-danger btn-sm fa fa-trash-o btnDelete" data-id='.$transaction["id"].'></a>';
        })
        ->editColumn('contact_id', function($transaction){ 
            $receiver = Contact::find($transaction->contact_id);
            return $receiver->name;
        })
        ->editColumn('created_at', function($transaction){
            return $transaction->created_at->format('H:i:s d/m/Y');
        })
        ->editColumn('updated_at', function($transaction){
            return $transaction->updated_at->format('H:i:s d/m/Y');
        })
        ->editColumn('total', function($transaction){
            return number_format($transaction->total, 2);
        })
        ->setRowId(function ($transaction) {
            return 'row-'.$transaction->id;
        })
        ->make(true);
    }

    //trader load import transaction detail - chi tiết giao dịch nhập hàng
    public function traderTranImportDetail($id)
    {
        $trans_info = Transaction::where('id',$id)->first();
        $farmer = User::find($trans_info->trader_id)->first();
        $receiver = Contact::where('id', $trans_info->contact_id)->first();
        return view('farmer_trader.trader.transaction.import_detail',[
            'farmer'=> $farmer,
            'receiver' => $receiver,
            'trans_info' => $trans_info,
        ]);
    }

    public function traderGetTranImportDetail($tran_id)
    {
        $list_product = TransactionDetail::where('transaction_id', $tran_id)->get();

        return Datatables::of($list_product)
        ->addColumn('thumbnail', function($product){
            return $product->products->thumbnail;
        })
        ->addColumn('unit', function($product){ 
            return $product->products->unit;
        })
        ->addColumn('product_name', function($product){
            return $product->products->name;
        })
        ->addColumn('sum', function($product){
            return number_format($product->price*$product->quantity*(100-$product->discount)/100, 2)." VNĐ";
        })
        ->editColumn('price', function($product){
            return number_format($product->price, 2);
        })
        ->editColumn('discount', function($product){
            return number_format($product->discount, 2)." %";
        })
        ->setRowId(function ($product) {
            return 'row-'.$product->id;
        })
        ->make(true);
    }

    //trader load import transaction detail - chi tiết giao dịch nhập hàng
    public function traderTranExportDetail($id)
    {
        $trans_info = Transaction::where('id',$id)->first();
        $receiver = Contact::where('id', $trans_info->contact_id)->first();
        return view('farmer_trader.trader.transaction.export_detail',[
            'receiver' => $receiver,
            'trans_info' => $trans_info,
        ]);
    }

    public function traderGetTranExportDetail($tran_id)
    {
        $list_product = TransactionDetail::where('transaction_id', $tran_id)->get();

        return Datatables::of($list_product)
        ->addColumn('thumbnail', function($product){
            return $product->products->thumbnail;
        })
        ->addColumn('unit', function($product){ 
            return $product->products->unit;
        })
        ->addColumn('product_name', function($product){
            return $product->products->name;
        })
        ->addColumn('sum', function($product){
            return number_format($product->price*$product->quantity*(100-$product->discount)/100, 2)." VNĐ";
        })
        ->editColumn('price', function($product){
            return number_format($product->price, 2);
        })
        ->editColumn('discount', function($product){
            return number_format($product->discount, 2)." %";
        })
        ->setRowId(function ($product) {
            return 'row-'.$product->id;
        })
        ->make(true);
    }
}

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
use Illuminate\Support\Facades\DB;

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
            return '<a title="Detail" href="http://agri.me/farmer/transaction/'.$transaction['id'].'" class="btn btn-info btn-sm fa fa-eye btnShow" data-id="'.$transaction["id"].'" id="row-'.$transaction["id"].'"></a>&nbsp;<a title="Update" class="btn btn-warning btn-sm fa fa-pencil btnEdit" data-id='.$transaction["id"].'></a>&nbsp;<a title="Delete" class="btn btn-danger btn-sm fa fa-trash-o btnDelete" data-id='.$transaction["id"].'></a>';
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
            return number_format($transaction->total, 3);
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

    public function farmerEdit($id)
    {
        return Transaction::find($id);
    }

    public function farmerUpdate(Request $request, $id)
    {
        $data = $request->all();
        if ($request->status == 1 && $request->payment==0 ) {
            return response()->json(['error' => 'Giao dịch chỉ hoàn thành khi đã được thanh toán'], 200);
        }
        $transaction =  Transaction::find($id);
        // $trader = User::where('id', $transaction->trader_id)->first();

        if ($request->status == 1 && $request->payment == 1) {
            $transaction_detail_list = TransactionDetail::where('transaction_id', $id)->get();
            foreach ($transaction_detail_list as $key => $transaction_detail) {
                $product = Product::where([
                    ['id', '=', $transaction_detail->product_id],
                    ['farmer_id', '=', $transaction->farmer_id]
                ])->first()->toArray();
                //Update số lượng của nông dân
                Product::find($product['id'])->update(['quantity' => ($product['quantity'] - $transaction_detail->quantity )]);
                //Update số lượng của thương lái
                //Kiểm tra thương lái có nông sản này không, nếu không thì tạo mới, ngược lại update
                $pro_trader = Product::where([
                    ['name', '=', $product['name']],
                    ['farmer_id', '=', $transaction->trader_id]
                ])->first();
                if ($pro_trader) {
                    Product::find($pro_trader['id'])->update(['quantity' => $pro_trader['quantity'] + $transaction_detail->quantity]);
                } else {
                    $product['quantity'] = $transaction_detail->quantity;
                    $product['farmer_id'] = $transaction->trader_id;
                    $product['slug'] = str_slug($product['name']).md5($product['farmer_id']);
                    Product::create($product);
                } 
            }
        }
        $update =  Transaction::where('id', $id)->update($data);
        if ($update ==1)    {
            $transaction =  Transaction::find($id);
            $trader = User::where('id', $transaction->trader_id)->first();
            $transaction['trader'] = $trader['name'];
            if ($transaction['status']==1) {
                $transaction['status'] = 'Đã hoàn thành';
            } else if ($transaction['status']==0){
                $transaction['status'] = 'Đang xử lý';
            } else {
                $transaction['status'] = 'Đã xử lý/ Đang giao hàng';
            }
            $transaction['payment'] = $transaction['payment']==1? 'Đã thanh toán': "Chưa thanh toán";
            return $transaction; 
        } 
        return $response()->json([], 400);
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
            return '<a title="Detail" href="http://agri.me/trader/transaction/import/'.$transaction['id'].'" class="btn btn-info btn-sm fa fa-eye btnShow" data-id="'.$transaction["id"].'" id="row-'.$transaction["id"].'"></a>&nbsp;<a title="Delete" class="btn btn-danger btn-sm fa fa-trash-o btnDelete" data-id='.$transaction["id"].'></a>';
        })
        ->editColumn('farmer_id', function($transaction){ 
            $farmer = User::find($transaction->farmer_id);
            return $farmer->name;
        })
        ->editColumn('payment', function($transaction){
            return $transaction->payment==1?"Đã thanh toán":"Chưa thanh toán";
        })
        ->editColumn('status', function($transaction){
            if ($transaction->status==1) {
                return  'Đã hoàn thành';
            } else if ($transaction->status==0){
                return  'Đang xử lý';
            } else {
                return  'Đã xử lý/ Đang giao hàng';
            }
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

    public function traderEditExTran($id)
    {
        return Transaction::find($id);
    }

    public function traderUpdateExTran(Request $request, $id)
    {
        $data = $request->all();
        if ($request->status == 1 && $request->payment==0 ) {
            return response()->json(['error' => 'Giao dịch chỉ hoàn thành khi đã được thanh toán'], 200);
        }
        $transaction =  Transaction::where('id', $id)->first();
        // $trader = User::where('id', $transaction->trader_id)->first();

        if ($request->status == 1 && $request->payment == 1) {
            $transaction_detail_list = TransactionDetail::where('transaction_id', $id)->get();
            foreach ($transaction_detail_list as $key => $transaction_detail) {
                $product = DB::table('products')->where('id', '=', $transaction_detail->product_id)->first();
                //Update số lượng của thương lái
                $qty = $product->quantity - $transaction_detail->quantity;
                DB::table('products')->where('id', $product->id)->update(['quantity' => $qty]);
            }
        }
        $update =  Transaction::where('id', $id)->update($data);
        if ($update ==1)    {
            $transaction =  Transaction::find($id);
            $trader = Contact::where('id', $transaction->contact_id)->first();
            $transaction['trader'] = $trader['name'];
            if ($transaction['status']==1) {
                $transaction['status'] = 'Đã hoàn thành';
            } else if ($transaction['status']==0){
                $transaction['status'] = 'Đang xử lý';
            } else {
                $transaction['status'] = 'Đã xử lý/ Đang giao hàng';
            }
            $transaction['payment'] = $transaction['payment']==1? 'Đã thanh toán': "Chưa thanh toán";
            return $transaction; 
        } 
        return $response()->json([], 400);
    }

    //SHOPPING CART
    public function addCart($id)
    {
        $product = Product::find($id);
        $rows = \Cart::content();
        /**
         * $rows : COLLECTION type
         * $cartItem: call item in Collection
         * $rowId: field returned, use($id): using $id to be parameter
         * @var [type]
         */
        $rowId = $rows->search(function($cartItem, $rowId) use($id) {
            return ($cartItem->id == $id);
        });   
        if ($rowId!=false) {  

            $item = \Cart::get($rowId);
            
            return \Cart::update($rowId, $item->qty+1);
        } else {
            return \Cart::add($id, $product['name'], 1, $product['price'], ['thumbnail' => $product['thumbnail'],
                'discount' => $product['discount'], 'unit' => $product['unit'], 'farmer_id' => $product['farmer_id'],
            ]);
        }  

    }

    /**
     * get list product
     * @return [type] [description]
     */
    public function getCart()
    {
        $list = \Cart::content();
        // dd($list);s
        return view('channel.pages.cart',[
            'list'=>\Cart::content(),
            'count' => \Cart::count(),
            'total' => \Cart::total(),
            'tax' => \Cart::tax(),
        ]);
    }

    /**
     * increase quantity of food/ drink
     * @param  Request $request [description]
     * @return food/drink has been updated
     */
    public function increase($rowId)
    {       
        $item = \Cart::get($rowId); 
        $product = Product::find($item->id);    
        return array(
            'item'=> \Cart::update($rowId,  [
                'qty'=>$item->qty+1,
                'thumbnail' => $product['thumbnail'],
                'discount' =>$product['discount']
            ]),
            'total'=> \Cart::total(),
            'tax' =>\Cart::tax()
        );
    }

    /**
     * decrease quantity of food/ drink
     * @param  Request $request [description]
     * @return food/drink has been updated
     */
    public function decrease($rowId)
    {       
        $item = \Cart::get($rowId);
        if ($item->qty==1) {
            return array(
                'item'=>\Cart::remove($rowId),
                'total' => \Cart::total(),
                'tax' => \Cart::tax(),
            );
        } else {
            $product = Product::find($item->id);    
            return array(
                'item'=> \Cart::update($rowId,  [
                    'qty'=>$item->qty-1,
                    'thumbnail' => $product['thumbnail'],
                    'discount' =>$product['discount']
                ]),
                'total'=> \Cart::total(),
                'tax' =>\Cart::tax()
            );
        }       
    }

    /**
     * save booking 's information to db'
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function pay(Request $request)
    {
        $data = $request->all();
        $date = date('YmdHis', time());
        $data['username'] = $date.str_slug($request->name);
        $receiver = Contact::create($data);       
        
        \Cart::content()->groupBy('options.farmer_id');

        $rows = \Cart::content()->groupBy('options.farmer_id');
        // dd($rows);
        if (!$rows->count()==0) {  
            foreach ($rows as $farmer_id => $list_product){
                $total = 0;                
                $transaction_detail = array();
                foreach ($list_product as $key => $product) {
                    $total += $product->qty*(100-$product->options->discount)/100*$product->price;
                    $pro = array(
                        'product_id' => $product->id,
                        'quantity' => $product->qty,
                        'price' => $product->price,
                        'discount' => $product->options->discount,
                    );
                    $transaction_detail[] = $pro;
                }
                // dd($transaction_detail);
                $transaction = array(
                    'farmer_id' => $farmer_id,
                    'trader_id' => Auth::id(),
                    'contact_id' => $receiver->id,
                    'total' => $total,
                );
                // dd($transaction);
                $transaction_store = Transaction::create($transaction);
                // dd($transaction_store);
                foreach ($transaction_detail as $key => $transaction) {
                    $transaction['transaction_id'] = $transaction_store->id;
                    TransactionDetail::create($transaction);
                }
            }
        } 
        \Cart::destroy();
        return redirect()->route('channel.home');
    }
}

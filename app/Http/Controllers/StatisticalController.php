<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Transaction;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StatisticalController extends Controller
{
	public function getProductPage()
	{
		return view('farmer_trader.farmer.statistical.product');
	}

	public function getProductStatistical(Request $request)
	{
		$result = Product::where([
			['farmer_id','=', Auth::id()],
			['delete','=', 0],
			['created_at', '>=', date($request->date_from)." 00:00:00"],
			['updated_at', '<=', date($request->date_to)." 23:59:59"],
		])->select('name', 'quantity')->get();
		$max = $result->max('quantity');

    	// return $end_data;
		$end_data = array();
		foreach ($result as $key => $row) {
			$end_data['quantity'][] = $row['quantity'];
			$end_data['list_name'][] = $row['name'];
		}
		return $end_data;
	}


	public function getTransactionPage()
	{
		return view('farmer_trader.farmer.statistical.transaction');
	}

	public function getTransactionStatistical(Request $request)
	{
		$result = Transaction::where([
			['farmer_id','=', Auth::id()],
			['farmer_delete','=', 0],
			['created_at', '>=', date($request->tran_date_from)." 00:00:00"],
			['created_at', '<=', date($request->tran_date_to)." 23:59:59"],
		])->groupBy('date')
		->orderBy('created_at', 'DESC')
		->get(array(DB::raw('Date(created_at) as date'),DB::raw('COUNT(*) as "quantity"')));

		$data = array();
		
		foreach ($result as $key => $row) {
			$data[$row->date] = $row->quantity;
		}
		// return $data;
		$date_from = date($request->tran_date_from);
		$date_to = date($request->tran_date_to);
		while (strtotime($date_from)<=strtotime($date_to)) {
			if (!array_key_exists(date($date_from), $data)) {
				$data[$date_from]=0;
			}
			$date_from = date ("Y-m-d", strtotime("+1 day", strtotime($date_from)));
		}
		ksort($data);
		$end_data = array();
		foreach ($data as $key => $value) {
			$end_data['list_time'][] = $key;			
			$end_data['list_quantity'][] = $value;			
		}
		return $end_data;
	}

	public function getSalesPage()
	{
		return view('farmer_trader.farmer.statistical.sales');
	}

	public function getSalesStatistical(Request $request)
	{
		$result = Transaction::where([
			['farmer_id','=', Auth::id()],
			['farmer_delete','=', 0],
			['created_at', '>=', date($request->date_from)." 00:00:00"],
			['created_at', '<=', date($request->date_to)." 23:59:59"],
		])->groupBy('date')
		->orderBy('created_at', 'DESC')
		->get(array(DB::raw('Date(created_at) as date'),DB::raw('SUM(total) as "total"')));

		$data = array();
		
		foreach ($result as $key => $row) {
			$data[$row->date] = $row->total;
		}
		// return $data;
		$date_from = date($request->date_from);
		$date_to = date($request->date_to);
		while (strtotime($date_from)<=strtotime($date_to)) {
			if (!array_key_exists(date($date_from), $data)) {
				$data[$date_from]=0;
			}
			$date_from = date ("Y-m-d", strtotime("+1 day", strtotime($date_from)));
		}
		ksort($data);
		$end_data = array();
		foreach ($data as $key => $value) {
			$end_data['list_date'][] = $key;			
			$end_data['list_total'][] = $value;			
		}
		return $end_data;
	}

	public function getTraderProductPage()
	{
		return view('farmer_trader.trader.statistical.product');
	}

	public function getTraderProductStatistical(Request $request)
	{
		$result = Product::where([
			['farmer_id','=', Auth::id()],
			['delete','=', 0],
			['created_at', '>=', date($request->date_from)." 00:00:00"],
			['updated_at', '<=', date($request->date_to)." 23:59:59"],
		])->select('name', 'quantity')->get();
		$max = $result->max('quantity');

    	// return $end_data;
		$end_data = array();
		foreach ($result as $key => $row) {
			$end_data['quantity'][] = $row['quantity'];
			$end_data['list_name'][] = $row['name'];
		}
		return $end_data;
	}


	public function getTraderTransactionPage()
	{
		return view('farmer_trader.trader.statistical.transaction');
	}

	public function getTraderTransactionStatistical(Request $request)
	{
		//nhập hàng
		$result = Transaction::where([
			['trader_id','=', Auth::id()],
			['trader_delete','=', 0],
			['typeTran', '=', 0],
			['created_at', '>=', date($request->tran_date_from)." 00:00:00"],
			['created_at', '<=', date($request->tran_date_to)." 23:59:59"],
		])->groupBy('date')
		->orderBy('created_at', 'DESC')
		->get(array(DB::raw('Date(created_at) as date'),DB::raw('COUNT(*) as "quantity"')));

		$data = array();
		
		foreach ($result as $key => $row) {
			$data[$row->date] = $row->quantity;
		}
		// return $data;
		$date_from = date($request->tran_date_from);
		$date_to = date($request->tran_date_to);
		while (strtotime($date_from)<=strtotime($date_to)) {
			if (!array_key_exists(date($date_from), $data)) {
				$data[$date_from]=0;
			}
			$date_from = date ("Y-m-d", strtotime("+1 day", strtotime($date_from)));
		}
		ksort($data);
		$end_data = array();
		foreach ($data as $key => $value) {
			$end_data['import']['list_time'][] = $key;			
			$end_data['import']['list_quantity'][] = $value;			
		}

		//xuất hàng
		$result1 = Transaction::where([
			['trader_id','=', Auth::id()],
			['trader_delete','=', 0],
			['typeTran', '=', 1],
			['created_at', '>=', date($request->tran_date_from)." 00:00:00"],
			['created_at', '<=', date($request->tran_date_to)." 23:59:59"],
		])->groupBy('date')
		->orderBy('created_at', 'DESC')
		->get(array(DB::raw('Date(created_at) as date'),DB::raw('COUNT(*) as "quantity"')));

		$data1 = array();
		foreach ($result1 as $key => $row) {
			$data1[$row->date] = $row->quantity;
		}
		while (strtotime($date_from)<=strtotime($date_to)) {
			if (!array_key_exists(date($date_from), $data1)) {
				$data1[$date_from]=0;
			}
			$date_from = date ("Y-m-d", strtotime("+1 day", strtotime($date_from)));
		}
		ksort($data1);

		foreach ($data1 as $key => $value) {
			$end_data['export']['list_time'][] = $key;			
			$end_data['export']['list_quantity'][] = $value;			
		}
		return $end_data;
	}

	public function getTraderSalesPage()
	{
		return view('farmer_trader.trader.statistical.sales');
	}

	public function getTraderSalesStatistical(Request $request)
	{
		$result = Transaction::where([
			['trader_id','=', Auth::id()],
			['trader_delete','=', 0],
			['typeTran', '=', 1],
			['created_at', '>=', date($request->date_from)." 00:00:00"],
			['created_at', '<=', date($request->date_to)." 23:59:59"],
		])->groupBy('date')
		->orderBy('created_at', 'DESC')
		->get(array(DB::raw('Date(created_at) as date'),DB::raw('SUM(total) as "total"')));

		$data = array();
		
		foreach ($result as $key => $row) {
			$data[$row->date] = $row->total;
		}
		// return $data;
		$date_from = date($request->date_from);
		$date_to = date($request->date_to);
		while (strtotime($date_from)<=strtotime($date_to)) {
			if (!array_key_exists(date($date_from), $data)) {
				$data[$date_from]=0;
			}
			$date_from = date ("Y-m-d", strtotime("+1 day", strtotime($date_from)));
		}
		ksort($data);
		$end_data = array();
		foreach ($data as $key => $value) {
			$end_data['list_date'][] = $key;			
			$end_data['list_total'][] = $value;			
		}
		return $end_data;

	}
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
	protected $table = 'transactions';

	protected $fillable = [
		'farmer_id', 'trader_id', 'contact_id', 'status', 'payment', 'typeTran', 'total', 'farmer_delete', 'trader_delete',
	]; 

	public function transaction_detail()
	{
		return $this->hasMany('App\TransactionDetail');
	}

	public function contact()
	{
		return $this->hasOne('App\Contact');
	}
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $table = 'transaction_details';

	protected $fillable = [
		'product_id', 'quantity', 'discount', 'price', 'transaction_id',
	]; 

	public function transaction()
	{
		return $this->belongsTo('App\Transaction');
	}

	public function products()
	{
		return $this->hasOne('App\Product', 'id', 'product_id');
	}
}

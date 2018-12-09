<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'name', 'farmer_id', 'category_id', 'slug', 'thumbnail', 'price', 'unit',  'quantity', 'description', 'discount', 'content', 'delete',
    ];

    protected $table = 'products';

    /**
     * Get the user that owns the phone.
     */
    public function category()
    {
    	return $this->belongsTo('App\Category');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function transactionDetail()
    {
        return $this->belongsToMany('App\TransactionDetail', 'id', 'product_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'name', 'slug', 'description'
    ];

    protected $table = 'categories';

    public function products()
    {
    	return $this->hasMany('App\Product', 'category_id', 'id');
    }
}

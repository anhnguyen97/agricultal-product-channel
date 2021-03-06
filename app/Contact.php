<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Admin;
use App\User;

class Contact extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mobile', 'address', 'username', 'name'
    ];

    protected $table = 'contacts';

    public function admin()
    {
    	return $this->belongsTo('App\Admin', 'username', 'username');
    }

    // public function user()
    // {
    //     return $this->belongsTo('App\User', 'id', 'uuid');
    // }

    public function user()
    {
    	return $this->belongsTo('App\User', 'username', 'username');
    }

    public function transactions()
    {
        return $this->belongsToMany('App\Transaction');
    }
}

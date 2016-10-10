<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = ['id'];

    /**
     * Get the category that owns the product.
     */
    public function category() {

    	return $this->belongsTo('App\Category', 'category_id', 'id');

    }

    /**
     * Get the user that owns the product.
     */
    public function user() {

    	return $this->belongsTo('App\User', 'user_id', 'id');

    }


}

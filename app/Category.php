<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Category extends Model
{
	protected $guarded = ['id'];

	use Sluggable;
	use SluggableScopeHelpers;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
    	return [
    		'category_name_slug' => [
    			'source' => 'category_name'
    		]
    	];
    }

    /**
     * Get the products for the category
    */

    public function products() {

        return $this->hasMany('App\Product', 'category_id', 'id');

    }

}

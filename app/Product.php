<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    	'category_id', 'supplier_id', 'productName', 'stock', 'purchasePrice', 'salePrice', 'description', 'photo', 
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Supplier');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Order');
    }

    public function images()
    {
        return $this->hasMany('App\Image');
    }

    public function videos()
    {
        return $this->hasMany('App\Video');
    }
}

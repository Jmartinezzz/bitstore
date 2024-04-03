<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'date', 'nOrder', 'state', 'total'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product', 'order_details')->withPivot('quantity', 'subTotal');
    }

    public function scopeOrderItems($query, $type, $request = null) {
        return $query->when($type == 'history', function ($q) {
            return $q->where('user_id', Auth::user()->id);
        }, function ($q) use ($request, $type) {
            return $q->where('id', $request->id);
        })
        ->where('state', 'pagado')
        ->with('products')
        ->orderBy('id', 'desc');
    }
}

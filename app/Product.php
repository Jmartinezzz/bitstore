<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Bot;

class Product extends Model
{
    use Bot;
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

    public static function verificarStock()
    {
        self::each(function ($item, $key) {
            if ($item->stock <= 10) {
                $botMsgContent = "⚠Producto con stock bajo: \n ✔️ producto: $item->productName \n  stock: $item->stock";
                self::sendInteraction($botMsgContent);
            }
        });
    }

    public function agregarSoldOut($cantidad)
    {
        $this->increment('soldout', $cantidad);
    }

    public function restarStock($cantidad)
    {
        $this->decrement('stock', $cantidad);
    }

    public function scopeSearch($query, $request)
    {
        return $query->where('productName', 'like', "%$request->buscar%")
                ->when($request->categoria != 0, function ($q) use ($request) {
                    return $q->where('category_id', $request->categoria);
                });
    }
}

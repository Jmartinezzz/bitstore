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

    public function verificarStock()
    {
        $this->each(function ($item, $key) {
            if ($item->stock <= 10) {
                /*para el bot*/ 
                try {
                    $botToken="1155339999:AAGBYb3Pu9dpScI5JxK-AyJLACOKmaZbD1c";
                    $website="https://api.telegram.org/bot".$botToken;
                    $fecha = date('d-m-Y h:i:s');

                    $tex=urlencode("⚠Producto con stock bajo: \n ✔️ producto: $item->productName \n  stock: $item->stock");   
                    file_get_contents($website."/sendmessage?chat_id=768944027&text=$tex");
                } catch (Exception $e) {
                        
                }
                /*final del bot*/    
            }
        });
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'companyName', 'contactName', 'title', 'email', 'phone',
    ];

    public function product()
    {
        return $this->hasOne('App\Product');
    }
}

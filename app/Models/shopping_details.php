<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shopping_details extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function productsName()
    {
        return $this->belongsTo(products::class, 'id_products');
    }

}

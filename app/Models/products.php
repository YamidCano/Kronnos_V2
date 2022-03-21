<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\product_category;
use App\Models\providers;

class products extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function proveedor()
    {
        return $this->belongsTo(providers::class , 'id_provider');
    }

    public function categoria()
    {
        return $this->belongsTo(product_category::class , 'id_product_categories');
    }
}
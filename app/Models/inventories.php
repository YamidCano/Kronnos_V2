<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inventories extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function producto()
    {
        return $this->belongsTo(products::class, 'id_product');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}

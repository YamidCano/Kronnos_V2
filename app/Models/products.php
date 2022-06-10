<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\product_category;
use App\Models\providers;
use App\Models\brands;
use Cviebrock\EloquentSluggable\Sluggable;

class products extends Model
{
    use HasFactory;
    use Sluggable;

    protected $guarded = [];

    // public function provider()
    // {
    //     return $this->belongsTo(providers::class , 'id_provider');
    // }

    public function brands()
    {
        return $this->belongsTo(brands::class , 'id_brands');
    }

    public function categoria()
    {
        return $this->belongsTo(product_category::class , 'id_product_categories');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}

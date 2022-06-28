<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class invoice extends Model
{
    use HasFactory;
    use Sluggable;
    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(User::class, 'id_client');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'id_seller');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'invoice_number'
            ]
        ];
    }
}

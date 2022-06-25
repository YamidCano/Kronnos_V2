<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class shopping extends Model
{
    use HasFactory;
    use Sluggable;
    protected $guarded = [];

    public function provider()
    {
        return $this->belongsTo(providers::class, 'id_provider');
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

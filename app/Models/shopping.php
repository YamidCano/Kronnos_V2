<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\providers;

class shopping extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function provider()
    {
        return $this->belongsTo(providers::class, 'id_provider');
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;

class EcommerceView extends Component
{
    public function render()
    {
        return view('livewire.ecommerce-view')->extends('layouts.ecommerce');
    }
}

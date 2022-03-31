<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\products;

class EcommerceView extends Component
{
    public $search, $perPage;
    public function render()
    {
        $slider =  products::query()
            ->where([['slider', 1], ['status', 0]])
            ->when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->where('name', 'like', "%{$this->search}%")
                        ->orWhere('description', 'like', "%{$this->search}%");
                });
            })
            ->paginate($this->perPage);

        $product =  products::query()
            ->where([['slider', 1], ['status', 0]])
            ->when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->where('name', 'like', "%{$this->search}%")
                        ->orWhere('description', 'like', "%{$this->search}%");
                });
            })
            ->paginate($this->perPage);

        return view('livewire.ecommerce-view', compact('slider', 'product'))->extends('layouts.ecommerce');
    }
}

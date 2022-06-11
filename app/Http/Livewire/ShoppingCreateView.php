<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\providers;
use App\Models\products;

class ShoppingCreateView extends Component
{
    public $invoiceNumber, $selectProvider, $date, $orderStatus, $idTaxe,  $note;
    public $providers;

    public $buscar, $product, $picked, $users_id, $idproduct, $stockproducto;

    public function render()
    {
        return view('livewire.shopping-create-view');
    }

    function rules()
    {
        return [
            'invoiceNumber' => 'required|min:3|max:256',
            'selectProvider' => 'required',
            'date' => 'required',
            'orderStatus' => 'required',
            'idTaxe' => 'required',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $this->providers = providers::orderBy('name')->get();

        $this->buscar = "";
        $this->product = [];
        $this->picked = false;
    }

    public function clean1()
    {
        $this->reset(['invoiceNumber']);
    }

    public function clean2()
    {
        $this->reset(['selectProvider']);
    }

    public function clean3()
    {
        $this->reset(['date']);
    }


    public function updatedBuscar()
    {
        $this->picked = false;

        // $this->validate([
        //     "buscar" => "required|min:2"
        // ]);

        $product = products::where('status', 0);

        $this->product = $product->where("name", "like", "%{$this->buscar}%")
            ->take(5)
            ->get();
    }

    public function asignarProduct(products $product)
    {
        $this->buscar = $product->name;
        $this->idproduct = $product->id;
        $this->picked = true;
    }

    public function asignarPrimero()
    {
        $product = products::where('status', 0);

        $product = $product->where("name", "like", "%{$this->buscar}%")->first();
        if ($product) {
            $this->buscar = $product->name;
            $this->idproduct = $product->id;
        } else {
            $this->buscar = "...";
        }
        $this->picked = true;
    }

    public function close()
    {
        $this->reset(['buscar', 'stockproducto', 'idproduct']);
        $this->buscar = "";
        $this->product = [];
        $this->picked = false;
        $this->resetErrorBag();
        $this->resetValidation();
    }
}

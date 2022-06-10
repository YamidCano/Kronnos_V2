<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\inventories;
use App\Models\products;
use App\Models\User;

class InventoriesView extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $perPage = 25;
    public $search, $name, $stock, $id_user, $quantity, $type = 0, $comments;

    public $buscar, $product, $picked, $users_id, $idproduct, $stockproducto;

    public function render()
    {
        $this->id_user = auth()->user()->id;

        if ($this->idproduct != null) {
            $products = products::find($this->idproduct);
            $this->stockproducto = $products->stock;
            if ($this->type == 1) {
                if ($this->quantity >  $this->stockproducto) {
                    $this->emit('alertError', 'El Stock ingresado no puede ser mayor al Stock Actual');
                    $this->quantity = null;
                }
            }
        }

        $inventories =  inventories::query()
            ->when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->where('comments', 'like', "%{$this->search}%")
                        ->orwhereHas('producto', function ($query) {
                            $query->where('name', 'like', "%{$this->search}%");
                        })
                        ->orwhereHas('usuario', function ($query) {
                            $query->where('name', 'like', "%{$this->search}%");
                        });
                });
            })
            ->paginate($this->perPage);

        return view('livewire.inventories-view', compact('inventories'));
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function rules(): array
    {
        return [

            'idproduct' => 'required',
            'id_user' => '',
            'quantity' => 'required',
            'comments' => '',
            'type' => 'required',
        ];
    }

    public function mount()
    {
        $this->buscar = "";
        $this->product = [];
        $this->picked = false;
    }

    public function clean()
    {
        $this->reset(['search']);
    }

    public function clean2()
    {
        $this->reset(['buscar', 'stockproducto', 'idproduct']);
        $this->buscar = "";
        $this->product = [];
        $this->picked = false;
    }

    public function close()
    {
        $this->reset(['buscar', 'stockproducto', 'idproduct', 'id_user', 'quantity', 'type', 'comments']);
        $this->buscar = "";
        $this->product = [];
        $this->picked = false;
    }

    public function updatedBuscar()
    {
        $this->picked = false;

        $this->validate([
            "buscar" => "required|min:2"
        ]);

        $product = products::where('status', 0);

        $this->product = $product->where("name", "like", "%{$this->buscar}%")
            ->take(5)
            ->get();
    }

    public function asignarUsuario(products $product)
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

    public function updatestock()
    {
        $this->validate();

        inventories::create([
            'id_product' => $this->idproduct,
            'id_user' => $this->id_user,
            'quantity' => $this->quantity,
            'type' => $this->type,
            'comments' => $this->comments,
        ]);

        if ($this->type == 0) {
            if ($update = products::where('id', $this->idproduct)->first()) {
                $update->stock = $this->stockproducto + $this->quantity;
                $update->save();
            }
        } else {
            if ($update = products::where('id', $this->idproduct)->first()) {
                $update->stock =  $this->stockproducto - $this->quantity;
                $update->save();
            }
        }

        $this->reset(['buscar', 'stockproducto', 'idproduct', 'id_user', 'quantity', 'type', 'comments']);
        $this->emit('Store');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->emit('alert', 'Registro creada sastifactoriamente');
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\providers;
use App\Models\products;
use App\Models\taxes;
use phpDocumentor\Reflection\Types\This;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class ShoppingCreateView extends Component
{
    public $invoiceNumber, $selectProvider, $date, $orderStatus, $idTaxe,  $note;
    public $providers;
    public $buscar, $product, $picked, $users_id, $idproduct, $stockproducto;
    public $totalCart, $cant = 0, $cartTotalQuantity, $quantityMas = 0, $taxesall;


    public $ordeproducts = [], $action = 1;

    public function render()
    {

        if ($this->idproduct != null) {
            $allproduct = products::find($this->idproduct);
            $exist = Cart::session(auth()->user()->id)->get($allproduct->id);
            if ($exist) {
                $this->emit('toastAlertError', 'Producto ya existe');
            } else {
                \Cart::session(auth()->user()->id)->add(array(
                    'id' =>  $allproduct->id,
                    'name' => $allproduct->name,
                    'price' => $allproduct->price,
                    'quantity' => 1,
                    'attributes' => array(),

                ));
                $this->emit('toastAlert', 'Producto Agregado');
            }
            $this->idproduct = '';
            $this->buscar = '';
        }

        $Cart = \Cart::session(auth()->user()->id)->getContent();

        return view('livewire.shopping-create-view', compact('Cart'));
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
    public function delete($idproduct)
    {
        \Cart::session(auth()->user()->id)->remove($idproduct);
        $this->emit('toastAlert', 'Producto Eliminado');
    }

    public function quantityMas($itemId, $quantity)
    {
        // $allproduct = products::find($itemId);
        // if ($quantity >= $allproduct->stock) {
        //     $this->emit('alertError', 'Stock Insuficiente');
        // } else {
        //     $quantity += 1;
        //     Cart::session(auth()->user()->id)->update($itemId, array(
        //         'quantity' => array(
        //             'relative' => false,
        //             'value' => $quantity
        //         ),
        //     ));
        // }

        $quantity += 1;
        Cart::session(auth()->user()->id)->update($itemId, array(
            'quantity' => array(
                'relative' => false,
                'value' => $quantity
            ),
        ));
    }

    public function quantityChange($itemId, $quantity)
    {
        if ($quantity <= 1) {
            \Cart::session(auth()->user()->id)->remove($itemId);
            $this->emit('toastAlert', 'Producto Eliminado');
        } else {
            Cart::session(auth()->user()->id)->update($itemId, array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $quantity
                ),
            ));
        }
    }

    public function quantitymenos($itemId, $quantity)
    {
        if ($quantity <= 1) {
            \Cart::session(auth()->user()->id)->remove($itemId);
            $this->emit('toastAlert', 'Producto Eliminado');
        } else {
            $quantity -= 1;
            Cart::session(auth()->user()->id)->update($itemId, array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $quantity
                ),
            ));
        }
    }

    public function mount()
    {
        $this->providers = providers::orderBy('name')->get();
        $this->taxesall = taxes::orderBy('name')->get();

        $this->buscar = "";
        $this->product = [];
        $this->picked = false;
    }

    public function updatedselectProvider($providerid)
    {
        $provider = providers::find($providerid);
        $this->providerName = $provider->name;
        $this->providerPhone = $provider->phone;
        $this->providerEmail = $provider->email;
        $this->providerRut = $provider->nit;
        \Cart::session(auth()->user()->id)->clear();
    }

    public function clean1()
    {
        $this->reset(['invoiceNumber']);
    }

    public function clean2()
    {
        $this->reset(['selectProvider', 'invoiceNumber', 'date']);
        \Cart::session(auth()->user()->id)->clear();
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

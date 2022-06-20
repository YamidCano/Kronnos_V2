<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\providers;
use App\Models\products;
use App\Models\taxes;
use App\Models\shopping;
use App\Models\shopping_details;
use phpDocumentor\Reflection\Types\This;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use PhpParser\Node\Stmt\Foreach_;

class ShoppingCreateView extends Component
{
    public $invoiceNumber, $selectProvider, $date, $orderStatus = 0, $idTaxe,  $note;
    public $providers, $taxRate = 1, $Subtotal, $total;
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
            'note' => '',
            'Subtotal' => '',
            'total' => '',
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

    public function updatedidTaxe($idtaxe)
    {
        // if ($idtaxe == '') {
        //     $this->reset(['taxRate', 'idTaxe']);
        // } else {

        //     $taxe = taxes::find($idtaxe);
        //     $taxRate = $taxe->tax_rate;
        //     $this->taxRate = '1.' . $taxRate;
        // }

        $taxe = taxes::find($idtaxe);
        $this->taxRate = '1.' . $taxe->tax_rate;
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
        $this->taxesall = taxes::orderBy('tax_rate')->get();

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
        $this->reset(['taxRate', 'idTaxe']);
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
        return redirect()->to('compras');
    }

    public function save()
    {
        $this->validate();

        $purchase = shopping::create([
            'invoice_number' => $this->invoiceNumber,
            'id_provider' => $this->selectProvider,
            'date' => $this->date,
            'order_status' => $this->orderStatus,
            'id_taxe' => $this->idTaxe,
            'note' => $this->note,
            'Subtotal' => \Cart::session(auth()->user()->id)->getTotal(),
            'total' => \Cart::session(auth()->user()->id)->getTotal() * $this->taxRate,
        ]);

        foreach (\Cart::session(auth()->user()->id)->getContent() as $value) {
            shopping_details::create([
                'id_shoppings' => $purchase->id,
                'id_products' => $value->id,
                'price' => $value->price,
                'quantity' => $value->quantity,
            ]);

            $product = products::find($value->id);
            $productstock = $product->stock + $value->quantity;
            $product->update([
                'stock' => $productstock,
            ]);
        }

        $this->close();
    }
}

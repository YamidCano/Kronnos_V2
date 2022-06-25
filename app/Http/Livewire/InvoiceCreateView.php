<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\products;
use App\Models\taxes;
use App\Models\invoice;
use App\Models\invoice_details;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Cviebrock\EloquentSluggable\Services\SlugService;

class InvoiceCreateView extends Component
{
    public $invoiceNumber = 'FV-0', $selectClients, $date, $orderStatus = 0, $idTaxe,  $note;
    public $users, $taxRate = 1, $Subtotal, $total, $slug, $idSeller;
    public $buscar, $product, $picked, $users_id, $idproduct, $stockproducto;
    public $totalCart, $cant = 0, $cartTotalQuantity, $quantityMas = 0, $taxesall;


    public $ordeproducts = [], $action = 1;

    public function render()
    {

        if ($this->idproduct != null) {
            $allproduct = products::find($this->idproduct);
            $this->stockproducto = $allproduct->stock;
            $exist = Cart::session(auth()->user()->id)->get($allproduct->id);
            if ($exist) {
                $this->emit('toastAlertError', 'Producto ya existe');
            } else {
                Cart::session(auth()->user()->id)->add(array(
                    'id' =>  $allproduct->id,
                    'name' => $allproduct->name,
                    'price' => $allproduct->price_sale,
                    'quantity' => 1,
                    'attributes' => array(),

                ));
                $this->emit('toastAlert', 'Producto Agregado');
            }
            $this->idproduct = '';
            $this->buscar = '';
        }

        $Cart = Cart::session(auth()->user()->id)->getContent();

        return view('livewire.invoice-create-view', compact('Cart'));
    }

    function rules()
    {
        return [
            'invoiceNumber' => 'required|min:3|max:256|unique:App\Models\shopping,invoice_number,',
            'selectClients' => 'required',
            'date' => 'required',
            'orderStatus' => 'required',
            'idTaxe' => '',
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
        Cart::session(auth()->user()->id)->remove($idproduct);
        $this->emit('toastAlert', 'Producto Eliminado');
    }

    public function quantityMas($itemId, $quantity)
    {
        $allproduct = products::find($itemId);
        if ($quantity >=  $allproduct->stock) {
            $this->emit('alertError', 'Stock Insuficiente, el estock limite es de '. $allproduct->stock );
        } else {
            $quantity += 1;
            Cart::session(auth()->user()->id)->update($itemId, array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $quantity
                ),
            ));
        }

        // $quantity += 1;
        // Cart::session(auth()->user()->id)->update($itemId, array(
        //     'quantity' => array(
        //         'relative' => false,
        //         'value' => $quantity
        //     ),
        // ));
    }

    public function updatedidTaxe($idtaxe)
    {
        $taxe = taxes::find($idtaxe);
        $this->taxRate = '1.' . $taxe->tax_rate;
    }

    public function quantityChange($itemId, $quantity)
    {

        $allproduct = products::find($itemId);
        if ($quantity >=  $allproduct->stock) {
            $this->emit('alertError', 'Stock Insuficiente, el estock limite es de '. $allproduct->stock );

            Cart::session(auth()->user()->id)->update($itemId, array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $allproduct->stock,
                ),
            ));
        } elseif ($quantity <= 1) {
            Cart::session(auth()->user()->id)->remove($itemId);
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
            Cart::session(auth()->user()->id)->remove($itemId);
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
        $this->users = User::orderBy('name')->get();
        $this->taxesall = taxes::orderBy('tax_rate')->get();

        $this->buscar = "";
        $this->product = [];
        $this->picked = false;

        $this->idSeller = auth()->user()->id;
    }

    public function updatedselectClients($clientId)
    {
        $user = User::find($clientId);
        $this->userName = $user->name;
        $this->userPhone = $user->phone;
        $this->userEmail = $user->email;
        $this->userIdentification = $user->identification;
        Cart::session(auth()->user()->id)->clear();
        $this->reset(['taxRate', 'idTaxe']);
    }

    public function clean1()
    {
        $this->reset(['invoiceNumber']);
    }

    public function clean2()
    {
        $this->reset(['selectClients', 'invoiceNumber', 'date']);
        Cart::session(auth()->user()->id)->clear();
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

        $this->createslug();

        $invoice = invoice::create([
            'invoice_number' => $this->invoiceNumber,
            'id_client' => $this->selectClients,
            'id_seller' => $this->idSeller,
            'date' => $this->date,
            'order_status' => $this->orderStatus,
            'id_taxe' => $this->idTaxe,
            'note' => $this->note,
            'slug' => $this->slug,
            'Subtotal' => Cart::session(auth()->user()->id)->getTotal(),
            'total' => Cart::session(auth()->user()->id)->getTotal() * $this->taxRate,
        ]);

        foreach (Cart::session(auth()->user()->id)->getContent() as $value) {
            invoice_details::create([
                'id_invoice' => $invoice->id,
                'id_product' => $value->id,
                'price' => $value->price,
                'quantity' => $value->quantity,
                'total' => Cart::session(auth()->user()->id)->get($value->id)->getPriceSum(),
            ]);

            $product = products::find($value->id);
            $productstock = $product->stock - $value->quantity;
            $product->update([
                'stock' => $productstock,
            ]);
        }

        $this->close();
    }

    private function createslug()
    {
        $this->slug = SlugService::createSlug(invoice::class, 'slug', $this->invoiceNumber);
    }
}

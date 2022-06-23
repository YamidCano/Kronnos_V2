<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\shopping;
use App\Models\paymentOut;
use App\Models\paymentMode;
use phpDocumentor\Reflection\Types\This;

class ShoppingView extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $perPage = 25, $perPage2 = 3, $search, $search2;
    public $invoiceNumber, $idProvider, $date, $orderStatus, $idTaxe, $note;
    public $total, $paymenAmount, $paymentDate, $paymentModes, $paymentMode, $paymentNote;
    public $id_shoppings, $difference, $paymentsum = 0;

    public function render()
    {

        $shopping =  shopping::query()
            ->when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->orwhereHas('provider', function ($query) {
                        $query->where('name', 'like', "%{$this->search}%");
                    });
                });
            })
            ->when($this->search2, function ($query2) {
                return $query2->where(function ($query2) {
                    $query2->where('invoice_number', 'like', "%{$this->search2}%");
                });
            })
            ->paginate($this->perPage);

        $shopping->each(function ($item) {
            $paymentOut = paymentOut::where('id_shoppings', $item->id)->sum('amount');
            return $item->sum = $paymentOut;
        });

        $paymentOut =  paymentOut::query()
            ->where('id_shoppings', $this->id_shoppings)
            ->paginate($this->perPage2);

        if ($this->paymenAmount != null) {
            $this->difference = $this->total - $this->paymentsum;
            if ($this->paymenAmount > $this->difference) {
                $this->emit('alertError', 'El Monto a pagar no puede ser mayor al Restante a pagar');
                $this->paymenAmount = null;
            }
        }

        $this->paymentsum = paymentOut::where('id_shoppings', $this->id_shoppings)->sum('amount');
        // $difference = $this->total - $this->paymentsum;
        // if ($difference == 0) {
        //     $this->emit('update');
        // }

        return view('livewire.shopping-view', compact('shopping', 'paymentOut'));
    }

    public function appMoney(shopping $shopping)
    {
        $this->id_shoppings = $shopping->id;
        $this->id_provider  = $shopping->id_provider;
        $this->total = $shopping->total;
    }

    public function close()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset(['paymenAmount', 'paymentDate', 'paymentMode']);
    }

    public function mount()
    {
        $this->paymentModes = paymentMode::get();
    }

    public function total()
    {
        $difference = $this->total - $this->paymentsum;
        $this->paymenAmount = $difference;
    }

    public function rules(): array
    {
        return [

            'paymenAmount' => 'required',
            'paymentDate' => 'required',
            'paymentNote' => '',
            'paymentMode' => 'required',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();

        paymentOut::create([
            'id_shoppings' => $this->id_shoppings,
            'id_provider' => $this->id_provider,
            'amount' => $this->paymenAmount,
            'date' => $this->paymentDate,
            'note' => $this->paymentNote,
            'id_payment_modes' => $this->paymentMode,
        ]);

        $this->close();
        $this->emit('alert', 'Pago creada sastifactoriamente');
    }

    public function clean1(){
        $this->reset(['search']);
    }

    public function clean2(){
        $this->reset(['search2']);
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\shopping;
use App\Models\paymentEntry;
use App\Models\paymentMode;
use App\Models\invoice;

class InvoiceView extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $perPage = 25, $perPage2 = 10, $search, $search2;
    public $invoiceNumber, $idClient, $idSeller, $date, $orderStatus, $idTaxe, $note;
    public $total, $paymenAmount, $paymentDate, $paymentModes, $paymentMode, $paymentNote;
    public $id_invoice, $difference, $paymentsum = 0;

    public function render()
    {
        $invoices =  invoice::query()
            ->when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->orwhereHas('client', function ($query) {
                        $query->where('name', 'like', "%{$this->search}%")
                            ->orWhere('last_name', 'like', "%{$this->search}%");
                    });
                    $query->orwhereHas('seller', function ($query) {
                        $query->where('name', 'like', "%{$this->search}%")
                            ->orWhere('last_name', 'like', "%{$this->search}%");
                    });
                });
            })
            ->when($this->search2, function ($query2) {
                return $query2->where(function ($query2) {
                    $query2->where('invoice_number', 'like', "%{$this->search2}%");
                });
            })
            ->paginate($this->perPage);

        $invoices->each(function ($item) {
            $paymentEntry = paymentEntry::where('id_invoice', $item->id)->sum('amount');
            return $item->sum = $paymentEntry;
        });

        $paymentEntrys =  paymentEntry::query()
            ->where('id_invoice', $this->id_invoice)
            ->paginate($this->perPage2);

        if ($this->paymenAmount != null) {
            $this->difference = $this->total - $this->paymentsum;
            if ($this->paymenAmount > $this->difference) {
                $this->emit('alertError', 'El Monto a pagar no puede ser mayor al Restante a pagar');
                $this->paymenAmount = null;
            }
        }

        $this->paymentsum = paymentEntry::where('id_invoice', $this->id_invoice)->sum('amount');
        // $difference = $this->total - $this->paymentsum;
        // if ($difference == 0) {
        //     $this->emit('update');
        // }

        return view('livewire.invoice-view', compact('invoices', 'paymentEntrys'));
    }

    public function appMoney(invoice $invoice)
    {
        $this->id_invoice = $invoice->id;
        $this->idClient  = $invoice->id_client;
        $this->idSeller  = $invoice->id_seller;
        $this->total = $invoice->total;
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
        $this->idSeller = auth()->user()->id;
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

        paymentEntry::create([
            'id_invoice' => $this->id_invoice,
            'id_user' => $this->idSeller,
            'id_client' => $this->idClient,
            'amount' => $this->paymenAmount,
            'date' => $this->paymentDate,
            'note' => $this->paymentNote,
            'id_payment_modes' => $this->paymentMode,
        ]);

        $this->close();
        $this->emit('alert', 'Pago creada sastifactoriamente');
    }

    public function clean1()
    {
        $this->reset(['search']);
    }

    public function clean2()
    {
        $this->reset(['search2']);
    }
}

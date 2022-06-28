<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\shopping;
use App\Models\shopping_details;
use App\Models\taxes;
use App\Models\providers;
use App\Models\paymentOut;

class PrintshoppingView extends Component
{
    public $providerName, $providerRut, $providerPhone, $providerEmail;
    public $invoiceNumber, $date, $note, $Subtotal, $total, $nameTaxe, $taxRate;
    public $shoppingDetails, $paymentOut, $slugss;

    public function render()
    {
        return view('livewire.printshopping-view');
    }

    public function mount($slug)
    {
        $shopping = shopping::where('slug', $slug)->first();
        $this->invoiceNumber = $shopping->invoice_number;
        $this->date = $shopping->date;
        $this->note = $shopping->note;
        $this->Subtotal = $shopping->Subtotal;
        $this->total = $shopping->total;

        $taxe = taxes::find($shopping->id_taxe);
        $this->nameTaxe = $taxe->name;
        $this->taxRate = $taxe->tax_rate;

        $provider = providers::find($shopping->id_provider);
        $this->providerName = $provider->name;
        $this->providerRut = $provider->nit;
        $this->providerPhone = $provider->phone;
        $this->providerEmail = $provider->email;

        $this->shoppingDetails = shopping_details::where('id_shoppings', $shopping->id)->get();

        $this->paymentOut = paymentOut::where('id_shoppings', $shopping->id)->sum('amount');
    }
}

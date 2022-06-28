<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\invoice;
use App\Models\invoice_details;
use App\Models\taxes;
use App\Models\User;
use App\Models\paymentEntry;

class PrintinvoiceView extends Component
{

    public $clientName, $clientRut, $clientPhone, $clientEmail;
    public $invoiceNumber, $date, $note, $Subtotal, $total, $nameTaxe, $taxRate;
    public $invoiceDetails, $paymentEntry, $isslug;

    public function render()
    {
        return view('livewire.printinvoice-view');
    }

    public function mount($slug)
    {

        $this->isslug = $slug;
        $invoice = invoice::where('slug',  $slug)->first();
        $this->invoiceNumber = $invoice->invoice_number;
        $this->date = $invoice->date;
        $this->note = $invoice->note;
        $this->Subtotal = $invoice->Subtotal;
        $this->total = $invoice->total;

        $taxe = taxes::find($invoice->id_taxe);
        $this->nameTaxe = $taxe->name;
        $this->taxRate = $taxe->tax_rate;

        $client = User::find($invoice->id_client);
        $this->clientName = $client->name;
        $this->clientRut = $client->identification;
        $this->clientPhone = $client->phone;
        $this->clientEmail = $client->email;

        $this->invoiceDetails = invoice_details::where('id_invoice', $invoice->id)->get();

        $this->paymentEntry = paymentEntry::where('id_invoice', $invoice->id)->sum('amount');
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\paymentEntry;
use App\Models\invoice;
use Livewire\Component;

class DashboardView extends Component
{

    public $user_id, $rol;
    public $invoices, $invoicesTotal = 0, $paymentEntry = 0, $balance = 0 , $percent = 0;
    public function render()
    {
        return view('livewire.dashboard-view');
    }

    public function mount()
    {

        $this->user_id = auth()->user()->id;
        $this->rol = auth()->user()->id_roles;

        if (is_null($this->rol)) {
            $this->invoicesCont = invoice::where('id_client', auth()->user()->id)->count();

            $this->invoices = invoice::where('id_client', auth()->user()->id)->get();

            $this->invoicesTotal = invoice::where('id_client', auth()->user()->id)->sum('total');


            $this->paymentEntry = paymentEntry::where('id_client', auth()->user()->id)->sum('amount');

            $this->balance = $this->invoicesTotal - $this->paymentEntry;

            if ( $this->paymentEntry > 0) {
                $this->percent = round( $this->paymentEntry / $this->invoicesTotal * 100);
            }

        }



    }
}

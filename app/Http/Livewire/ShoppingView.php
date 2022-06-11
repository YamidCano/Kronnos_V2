<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\shopping;


class ShoppingView extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $perPage = 25, $search, $search2;
    public $invoiceNumber, $idProvider, $date, $orderStatus, $idTaxe,  $note;

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

        return view('livewire.shopping-view', compact('shopping'));
    }

}

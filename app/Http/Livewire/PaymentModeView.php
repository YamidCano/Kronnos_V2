<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\paymentMode;
use App\Models\paymentOut;
use Livewire\WithPagination;

class PaymentModeView extends Component
{
    //Paginacion
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    //Declaramos variables publicas
    public $perPage = 25;
    public $search, $name, $paymentModeId;
    public $updating = false;

    //Actualizamos la vista
    protected $listeners = ['destroy'];

    public function render()
    {
        $paymentModes =  paymentMode::query()
            ->when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->where('name', 'like', "%{$this->search}%");
                });
            })
            ->paginate($this->perPage);

        $paymentModes->each(function ($item) {
            return $item->count_paymentOut = paymentOut::where('id_payment_modes', $item->id)->count();
        });

        return view('livewire.payment-mode-view', compact('paymentModes'));
    }

    //Decleramos campos sin validar

    public function rules(): array
    {
        if ($this->updating) {
            return [
                'name' => 'required|max:56|unique:App\Models\paymentMode,name,' . optional($this->paymentMode)->id,
            ];
        } else {
            return [
                'name' => 'required|max:56|unique:App\Models\paymentMode,name,',
            ];
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function clean()
    {
        $this->reset(['search']);
    }

    //Creamos el registro
    public function save()
    {
        //Validamos los campos
        $this->validate();

        //Guardamos los registros
        paymentMode::create([
            'name' => $this->name,
        ]);

        //Cerramos la ventana modal
        $this->emit('Store');
        $this->close();
        $this->emit('alert', 'Registro creada sastifactoriamente');
    }

    //Tramos los datos al editar y lo volcamos en variables
    public function edit(paymentMode $paymentMode)
    {
        $this->updating = true;
        $this->paymentMode = $paymentMode;
        $this->paymentModeId = $paymentMode->id;
        $this->name = $paymentMode->name;
    }
    //Actualizamos formulario de edicion
    public function update()
    {
        //Validamos los campos
        $this->validate();

        $paymentMode = paymentMode::find($this->paymentModeId);

        $paymentMode->update([
            'name' => $this->name,
        ]);
        $this->emit('update');
        $this->close();
        $this->emit('alert', 'Registro Actualizada sastifactoriamente');
    }

    public function destroy(paymentMode $paymentModeId)
    {
        $paymentModeId->delete();
        $this->close();
    }

    //Cerrar una ventana modal
    public function close()
    {
        //Limpiamos validaciones
        $this->resetErrorBag();
        $this->resetValidation();
        //Limpiamos Campos
        $this->reset(['name']);
    }
}

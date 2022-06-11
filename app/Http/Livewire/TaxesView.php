<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\taxes;
use Livewire\WithPagination;

class TaxesView extends Component
{
    //Paginacion
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    //Declaramos variables publicas
    public $perPage = 25;
    public $search, $name, $taxRate, $taxe;
    public $updating = false, $status = 0;

    //Actualizamos la vista
    protected $listeners = ['destroy'];

    public function render()
    {
        if ($this->taxRate >  99) {
            $this->emit('alertError', 'El impuesto no debe de ser mayor al 99%');
            $this->taxRate = null;
        }

        $taxes =  taxes::query()
            ->when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->where('name', 'like', "%{$this->search}%")
                        ->orWhere('tax_rate', 'like', "%{$this->search}%");
                });
            })
            ->paginate($this->perPage);

        // $providers->each(function ($item) {
        //     return $item->count_provider = products::where('id_provider', $item->id)->count();
        // });

        return view('livewire.taxes-view', compact('taxes'));
    }

    //Decleramos campos sin validar

    public function rules(): array
    {
        if ($this->updating == true) {
            return [
                'name' => 'required|max:56|unique:App\Models\taxes,name,' . optional($this->taxe)->id,
                'taxRate' => 'required',
            ];
        } else {
            return [
                'name' => 'required|max:56|unique:App\Models\taxes,name,',
                'taxRate' => 'required',
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
        taxes::create([
            'name' => $this->name,
            'tax_rate' => $this->taxRate,
        ]);

        //Cerramos la ventana modal
        $this->emit('Store');
        //Limpiamos validaciones
        $this->resetErrorBag();
        $this->resetValidation();
        //Limpiamos Campos
        $this->reset(['name', 'taxRate']);
        //Enviamos el mensaje de confirmacion
        $this->emit('alert', 'Registro creada sastifactoriamente');
    }

    //Tramos los datos al editar y lo volcamos en variables
    public function edit(taxes $taxe)
    {
        $this->updating = true;
        $this->taxe = $taxe;
        $this->taxeId = $taxe->id;
        $this->name = $taxe->name;
        $this->taxRate = $taxe->tax_rate;
    }
    //Actualizamos formulario de edicion
    public function update()
    {
        //Validamos los campos
        $this->validate();

        $taxes = taxes::find($this->taxeId);

        $taxes->update([
            'name' => $this->name,
            'tax_rate' => $this->taxRate,
        ]);
        $this->reset(['name', 'taxRate']);
        $this->emit('update');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->emit('alert', 'Registro Actualizada sastifactoriamente');
    }

    public function destroy(taxes $taxe)
    {
        $taxe->delete();
        //Limpiamos validaciones
        $this->resetErrorBag();
        $this->resetValidation();
        //Limpiamos Campos
        $this->reset(['name', 'taxRate']);
    }

    //Cerrar una ventana modal
    public function close()
    {
        //Limpiamos validaciones
        $this->resetErrorBag();
        $this->resetValidation();
        //Limpiamos Campos
        $this->reset(['name', 'taxRate']);
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\providers;
use Livewire\WithPagination;
use App\Models\products;

class ProvidersView extends Component
{
    //Paginacion
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    //Declaramos variables publicas
    public $perPage = 25;
    public $search, $name, $provider_id, $provider, $phone, $nit;

    //Actualizamos la vista
    protected $listeners = ['destroy'];

    public function render()
    {
        $providers =  providers::query()
            ->when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->where('name', 'like', "%{$this->search}%")
                        ->orWhere('phone', 'like', "%{$this->search}%")
                        ->orWhere('nit', 'like', "%{$this->search}%");
                });
            })
            ->paginate($this->perPage);

        $providers->each(function ($item) {
            return $item->count_provider = products::where('id_provider', $item->id)->count();
        });

        return view('livewire.providers-view', compact('providers'));
    }

    //Decleramos campos sin validar
    function rules()
    {
        return [
            'name' => '',
            'phone' => '',
            'nit' => '',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    //Creamos el registro
    public function save()
    {
        //Validamos los campos
        $this->validate([
            'name' => 'required|min:3|max:256',
            'phone' => 'required|min:10|max:10',
            'nit' => 'required|min:9|max:10|unique:App\Models\providers,nit,',
        ]);

        //Guardamos los registros
        providers::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'nit' => $this->nit,
        ]);

        //Cerramos la ventana modal
        $this->emit('Store');
        //Limpiamos validaciones
        $this->resetErrorBag();
        $this->resetValidation();
        //Limpiamos Campos
        $this->reset(['name', 'phone', 'nit']);
        //Enviamos el mensaje de confirmacion
        $this->emit('alert', 'Registro creada sastifactoriamente');
    }

    //Tramos los datos al editar y lo volcamos en variables
    public function edit(providers $provider)
    {
        $this->provider = $provider;
        $this->provider_id = $provider->id;
        $this->name = $provider->name;
        $this->phone = $provider->phone;
        $this->nit = $provider->nit;
    }

    //Actualizamos formulario de edicion
    public function update()
    {
        //Validamos los campos
        $this->validate([
            'name' => 'required|min:3|max:256',
            'phone' => 'required|min:10|max:10',
            'nit' => 'required|min:9|max:10|unique:App\Models\providers,nit,' . optional($this->provider)->id,
        ]);

        $provider = providers::find($this->provider_id);
        $provider->update([
            'name' => $this->name,
            'phone' => $this->phone,
            'nit' => $this->nit,
        ]);
        $this->reset(['name', 'phone', 'nit']);
        $this->emit('update');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->emit('alert', 'Registro Actualizada sastifactoriamente');
    }

    public function destroy(providers $provider)
    {
        $provider->delete();
        //Limpiamos validaciones
        $this->resetErrorBag();
        $this->resetValidation();
        //Limpiamos Campos
        $this->reset(['name', 'phone', 'nit']);
    }

    //Cerrar una ventana modal
    public function close()
    {
        //Limpiamos validaciones
        $this->resetErrorBag();
        $this->resetValidation();
        //Limpiamos Campos
        $this->reset(['name', 'phone', 'nit']);
    }
}

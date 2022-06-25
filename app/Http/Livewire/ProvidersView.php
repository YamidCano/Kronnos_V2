<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\providers;
use Livewire\WithPagination;
use App\Models\shopping;

class ProvidersView extends Component
{
    //Paginacion
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    //Declaramos variables publicas
    public $perPage = 25;
    public $search, $name, $provider_id, $provider, $phone, $nit, $address, $email, $city;
    public $updating = false, $status = 0;

    //Actualizamos la vista
    protected $listeners = ['destroy'];

    public function render()
    {
        $providers =  providers::query()
            ->when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->where('name', 'like', "%{$this->search}%")
                        ->orWhere('address', 'like', "%{$this->search}%")
                        ->orWhere('email', 'like', "%{$this->search}%")
                        ->orWhere('phone', 'like', "%{$this->search}%")
                        ->orWhere('nit', 'like', "%{$this->search}%");
                });
            })
            ->paginate($this->perPage);

        $providers->each(function ($item) {
            return $item->count_provider = shopping::where('id_provider', $item->id)->count();
        });

        return view('livewire.providers-view', compact('providers'));
    }

    //Decleramos campos sin validar

    public function rules(): array
    {
        if ($this->updating) {
            return [
                'name' => 'required|min:3|max:256|unique:App\Models\providers,name,' . optional($this->provider)->id,
                'phone' => 'required|min:10|max:10|unique:App\Models\providers,phone,' . optional($this->provider)->id,
                'nit' => 'required|min:9|max:10|unique:App\Models\providers,nit,' . optional($this->provider)->id,
                'email' => 'required|min:3|max:50|email|unique:App\Models\providers,email,' . optional($this->provider)->id,
                'city' => 'required',
                'address' => 'required',
                'status' => 'required',
            ];
        }

        return [
            'name' => 'required|min:3|max:256|unique:App\Models\providers,name,',
            'phone' => 'required|min:10|max:10|unique:App\Models\providers,phone,',
            'nit' => 'required|min:9|max:10|unique:App\Models\providers,nit,',
            'email' => 'required|min:3|max:50|email|unique:App\Models\providers,email',
            'city' => 'required',
            'address' => 'required',
            'status' => 'required',
        ];
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
        providers::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'nit' => $this->nit,
            'email' => $this->email,
            'city' => $this->city,
            'address' => $this->address,
            'status' => $this->status,
        ]);

        //Cerramos la ventana modal
        $this->emit('Store');
        //Limpiamos validaciones
        $this->resetErrorBag();
        $this->resetValidation();
        //Limpiamos Campos
        $this->reset(['name', 'phone', 'nit', 'email', 'city', 'address', 'status']);
        //Enviamos el mensaje de confirmacion
        $this->emit('alert', 'Registro creada sastifactoriamente');
    }

    //Tramos los datos al editar y lo volcamos en variables
    public function edit(providers $provider)
    {
        $this->updating = true;
        $this->provider = $provider;
        $this->provider_id = $provider->id;
        $this->name = $provider->name;
        $this->phone = $provider->phone;
        $this->nit = $provider->nit;
        $this->email = $provider->email;
        $this->address = $provider->address;
        $this->city = $provider->city;
        $this->status = $provider->status;
    }

    //Actualizamos formulario de edicion
    public function update()
    {
        //Validamos los campos
        $this->validate();

        $provider = providers::find($this->provider_id);
        $provider->update([
            'name' => $this->name,
            'phone' => $this->phone,
            'nit' => $this->nit,
            'email' => $this->email,
            'city' => $this->city,
            'address' => $this->address,
            'status' => $this->status,
        ]);
        $this->reset(['name', 'phone', 'nit', 'email', 'city', 'address', 'status']);
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
        $this->reset(['name', 'phone', 'nit', 'email', 'city', 'address', 'status']);
    }

    //Cerrar una ventana modal
    public function close()
    {
        //Limpiamos validaciones
        $this->resetErrorBag();
        $this->resetValidation();
        //Limpiamos Campos
        $this->reset(['name', 'phone', 'nit', 'email', 'city', 'address', 'status']);
    }
}

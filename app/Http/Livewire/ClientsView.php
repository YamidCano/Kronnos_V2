<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\clients;

class ClientsView extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $perPage = 25;
    public $search, $search1, $city, $identification;
    public $client, $client_id, $name, $email, $phone, $address, $status = 0;
    public $updating = false;

    protected $listeners = ['statusActivate', 'statusDeactivate'];

    public function render()
    {
        $clients =  clients::query()
            // ->where('name', 'like', "%{$this->search}%")
            ->when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->where('name', 'like', "%{$this->search}%")
                        ->orWhere('email', 'like', "%{$this->search}%")
                        ->orWhere('phone', 'like', "%{$this->search}%")
                        ->orWhere('identification', 'like', "%{$this->search}%");
                });
            })
            ->paginate($this->perPage);

        //Retornamos la vista y volcamos los datos
        return view('livewire.clients-view', compact('clients'));
    }

    //Decleramos campos sin validar
    public function rules(): array
    {
        if ($this->updating) {
            return [
                'name' => 'required|min:3|max:256',
                'identification' => 'required|min:7|max:10|unique:App\Models\clients,identification,' . optional($this->client)->id,
                'email' => 'required|min:3|max:50|email|unique:App\Models\clients,email,' . optional($this->client)->id,
                'phone' => 'required|min:3|max:11',
                'city' => 'required|min:3|max:256',
                'address' => 'required',
            ];
        }

        return [
            'name' => 'required|min:3|max:256|regex:/^[\pL\s\-]+$/u',
            'identification' => 'required|min:7|max:10|unique:App\Models\clients,identification',
            'email' => 'required|min:3|max:50|email|unique:App\Models\clients,email',
            'phone' => 'required|min:3|max:11',
            'city' => 'required|min:3|max:256',
            'address' => 'required',
            'status' => 'required',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    //Creamos el registro
    public function save()
    {
        $this->validate();

        clients::create([
            'name' => $this->name,
            'identification' => $this->identification,
            'email' => $this->email,
            'phone' => $this->phone,
            'city' => $this->city,
            'address' => $this->address,
            'status' => $this->status,
        ]);
        $this->emit('Store');
        $this->close();
        $this->emit('alert', 'Registro creada sastifactoriamente');
    }

    public function edit(clients $client)
    {
        $this->updating = true;
        $this->client = $client;
        $this->client_id = $client->id;
        $this->name = $client->name;
        $this->identification = $client->identification;
        $this->email = $client->email;
        $this->phone = $client->phone;
        $this->address = $client->address;
        $this->status = $client->status;
        $this->city = $client->city;
    }

    public function update()
    {
        $this->validate();
        //Guardamos los registros
        if ($update = clients::where('id', $this->client->id)->first()) {
            $update->name = $this->name;
            $update->identification = $this->identification;
            $update->email = $this->email;
            $update->phone = $this->phone;
            $update->address = $this->address;
            $update->city = $this->city;

            $update->save();
        }
        $this->emit('update');
        $this->close();
        $this->emit('alert', 'Registro Actualizada sastifactoriamente');
    }

    public function close()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset(['name', 'email', 'phone', 'city', 'address', 'identification',]);
    }

    public function statusDeactivate(clients $client)
    {
        $this->client = $client;
        $this->status = 1;
        if ($update = clients::where('id', $this->client->id)->first()) {
            $update->status = $this->status;
            $update->save();
        }
    }

    public function statusActivate(clients $client)
    {
        $this->client = $client;
        $this->status = 0;
        if ($update = clients::where('id', $this->client->id)->first()) {
            $update->status = $this->status;
            $update->save();
        }
    }

    public function clean()
    {
        $this->reset(['search']);
    }
}

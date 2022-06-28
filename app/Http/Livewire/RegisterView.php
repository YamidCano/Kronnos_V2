<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class RegisterView extends Component
{
    public $search;
    public $form = false;
    public $name, $last_name, $email, $phone, $address, $identification, $city, $status = 0, $client_id;
    public $password, $password_confirmation;


    public function render()
    {
        return view('livewire.register-view')->extends('layouts.auth');
    }

    function rules()
    {
        return [
            'password' => 'required|min:6',
            'password_confirmation' => 'same:password',
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

    public function search()
    {
        if ($client = User::where("identification", $this->search)->first()) {

            if (is_null($client->password)) {
                if ($client->status == 0) {

                    $this->emit('alert', 'Cliente Encontrado " ' . $client->name . ' ' . $client->last_name . ' " Por favor ingrese una contraseña');
                    $this->search = '';
                    $this->form = true;

                    $this->client_id = $client->id;
                    $this->name = $client->name;
                    $this->last_name = $client->last_name;
                    $this->identification = $client->identification;
                    $this->email = $client->email;
                    $this->phone = $client->phone;
                    $this->address = $client->address;
                    $this->status = $client->status;
                    $this->city = $client->city;
                } else {
                    $this->emit('alertError', 'El cliente " ' . $client->name . ' ' . $client->last_name . ' " se encuentra desabilitado');
                    $this->search = '';
                    $this->form = false;
                }
            } else {
                $this->emit('alertError', 'El Cliente " ' . $client->name . ' ' . $client->last_name . ' " ya se encuentra registrado');
                $this->search = '';
                $this->form = false;
            }
        } else {
            $this->emit('alertError', 'El cliente no exite en la base de datos');
            $this->search = '';
            $this->form = false;
        }
    }

    public function save()
    {
        $this->validate();

        if ($User = User::where('id', $this->client_id)->first()) {
            if (!is_null($this->password)) {
                $User->password = Hash::make($this->password);
            }
            $User->save();
        }
        $this->emit('alert', 'Registro creada sastifactoriamente');
        $this->form = false;
        $this->limpiar();
    }

    public function limpiar()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset(['last_name', 'name', 'email', 'phone', 'city', 'address', 'identification', 'password', 'password_confirmation']);
    }
}

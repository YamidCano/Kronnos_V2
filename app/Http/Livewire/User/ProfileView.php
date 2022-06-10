<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class ProfileView extends Component
{
    //Paginacion
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    //Declaramos variables publicas
    public $search, $search1, $city, $identification, $password, $password_confirmation, $selecRole;
    public $user, $user_id, $name, $last_name, $email, $phone, $address, $status = 0;

    public function render()
    {
        return view('livewire.user.profile-view');
    }

    //Traer Informacion al cargar  la vista
    public function mount()
    {

        $this->user_id = auth()->user()->id;
        $this->name = auth()->user()->name;
        $this->last_name = auth()->user()->last_name;
        $this->identification = auth()->user()->identification;
        $this->email = auth()->user()->email;
        $this->phone = auth()->user()->phone;
        $this->address = auth()->user()->address;
        $this->city = auth()->user()->city;
        // $this->selecRole = auth()->user()->id_roles;

        $user = User::find($this->user_id);
        $this->user = $user;

        $this->roles = Role::orderBy('name')->get();
    }

    //Decleramos campos sin validar
    function rules()
    {
        return [
            'name' => 'required|min:3|max:256|regex:/^[\pL\s\-]+$/u',
            'last_name' => 'required|min:3|max:256|regex:/^[\pL\s\-]+$/u',
            'identification' => 'required|min:7|max:10|unique:App\Models\User,identification,' . optional($this->user)->id,
            'email' => 'required|min:3|max:50|email|unique:App\Models\User,email,' . optional($this->user)->id,
            'phone' => 'required|min:3|max:11',
            'city' => 'required|min:3|max:256',
            'address' => 'required',
            // 'selecRole' => 'required',
            'password_confirmation' => 'same:password',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    //Actualizamos formulario de edicion
    public function update()
    {
        //Validamos los campos
        $this->validate();
        //Guardamos los registros
        if ($update = User::where('id', auth()->user()->id)->first()) {
            $update->name = $this->name;
            $update->last_name = $this->last_name;
            $update->identification = $this->identification;
            $update->email = $this->email;
            $update->phone = $this->phone;
            $update->address = $this->address;
            $update->city = $this->city;
            // $update->id_roles = $this->selecRole;

            if (!is_null($this->password)) {
                $update->password = Hash::make($this->password);
            }
            //Asignamos al usuario el rol selecionado
            // $update->syncRoles([$this->selecRole]);
            $update->save();
        }
        //Limpiamos validaciones
        $this->resetErrorBag();
        $this->resetValidation();

        //Enviamos el mensaje de confirmacion
        $this->emit('alert', 'Registro Actualizada sastifactoriamente');
        //Redireccionar a la pagina home
        // return redirect()->to('/home');
    }
}

<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Darbaoui\Avatar\Facades\Avatar;

class UserView extends Component
{
    //Paginacion
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    //Declaramos variables publicas
    public $perPage = 25;
    public $search, $search1, $city, $identification, $password, $password_confirmation;
    public $user, $user_id, $name,  $first_name, $last_name, $email, $phone, $address, $status = 0;

    //Actualizamos la vista
    protected $listeners = ['statusActivate', 'statusDeactivate'];

    public function render()
    {
        //declarmos una variables y tramos los datos de la tabla
        $users =  User::query()
            // ->where('name', 'like', "%{$this->search}%")
            ->when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->where('first_name', 'like', "%{$this->search}%")
                        ->orWhere('last_name', 'like', "%{$this->search}%")
                        ->orWhere('email', 'like', "%{$this->search}%")
                        ->orWhere('identification', 'like', "%{$this->search}%");
                });
            })
            ->paginate($this->perPage);

        //Retornamos la vista y volcamos los datos
        return view('livewire.user.user-view', compact('users'));
    }

    //Decleramos campos sin validar
    function rules()
    {
        return [
            'first_name' => '',
            'last_name' => '',
            'identification' => '',
            'email' => '',
            'phone' => '',
            'city' => '',
            'address' => '',
            'status' => '',
            'password' => '',
            'password_confirmation' => '',
        ];
    }

    //Creamos el registro
    public function save()
    {
        //Validamos los campos
        $this->validate([
            'first_name' => 'required|min:3|max:256',
            'last_name' => 'required|min:3|max:256',
            'identification' => 'required|min:7|max:10|unique:App\Models\User,identification',
            'email' => 'required|min:3|max:50|email|unique:App\Models\User,email',
            'phone' => 'required|min:3|max:11',
            'city' => 'required|min:3|max:256',
            'address' => 'required',
            'status' => 'required',
            'password' => 'required|min:6',
            'password_confirmation' => 'same:password',
        ]);

        User::create([ //Guardamos los registros
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'identification' => $this->identification,
            'email' => $this->email,
            'phone' => $this->phone,
            'city' => $this->city,
            'address' => $this->address,
            'status' => $this->status,
            'password' => bcrypt($this->password),
        ]);
        //Cerramos la ventana modal
        $this->emit('Store');
        //Limpiamos validaciones
        $this->resetErrorBag();
        $this->resetValidation();
        //Limpiamos Campos
        $this->reset(['last_name', 'first_name', 'email', 'phone', 'city', 'address', 'identification']);
        //Enviamos el mensaje de confirmacion
        $this->emit('alert', 'Registro creada sastifactoriamente');
    }

    //Tramos los datos al editar y lo volcamos en variables
    public function edit(User $user)
    {
        $this->user = $user;
        $this->user_id = $user->id;
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->identification = $user->identification;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->address = $user->address;
        $this->status = $user->status;
        $this->city = $user->city;
    }

    //Actualizamos formulario de edicion
    public function update()
    {
        //Validamos los campos
        $this->validate([
            'first_name' => 'required|min:3|max:256',
            'last_name' => 'required|min:3|max:256',
            'identification' => 'required|min:7|max:10|unique:App\Models\User,identification,' . optional($this->user)->id,
            'email' => 'required|min:3|max:50|email|unique:App\Models\User,email,' . optional($this->user)->id,
            'phone' => 'required|min:3|max:11',
            'city' => 'required|min:3|max:256',
            'address' => 'required',
            'password_confirmation' => 'same:password',
        ]);

        //Guardamos los registros
        if ($update = User::where('id', $this->user->id)->first()) {
            $update->first_name = $this->first_name;
            $update->last_name = $this->last_name;
            $update->identification = $this->identification;
            $update->email = $this->email;
            $update->phone = $this->phone;
            $update->address = $this->address;
            $update->city = $this->city;

            if (!is_null($this->password)) {
                $update->password = Hash::make($this->password);
            }

            // $update->syncRoles([$this->user->id_roles]);

            $update->save();
        }
        //Cerramos la ventana modal
        $this->emit('update');
        //Limpiamos validaciones
        $this->resetErrorBag();
        $this->resetValidation();
        //Limpiamos Campos
        $this->reset(['last_name', 'first_name', 'email', 'phone', 'city', 'address', 'identification']);
        //Enviamos el mensaje de confirmacion
        $this->emit('alert', 'Registro Actualizada sastifactoriamente');
    }

    //Cerrar una ventana modal
    public function close()
    {
        //Limpiamos validaciones
        $this->resetErrorBag();
        $this->resetValidation();
        //Limpiamos Campos
        $this->reset(['last_name', 'first_name', 'email', 'phone', 'city', 'address', 'identification']);
    }

    //Activar Usuario
    public function statusDeactivate(User $user)
    {
        $this->user = $user;
        $this->status = 1;
        if ($update = User::where('id', $this->user->id)->first()) {
            $update->status = $this->status;
            $update->save();
        }
    }

    //Desativar Usuario
    public function statusActivate(User $user)
    {
        $this->user = $user;
        $this->status = 0;
        if ($update = User::where('id', $this->user->id)->first()) {
            $update->status = $this->status;
            $update->save();
        }
    }

    //
    // protected function defaultProfilePhotoUrl()
    // {
    //     return 'https://ui-avatars.com/api/?name='.urlencode($this->name).'&color=FFFFFF&background=02555d';
    // }
}
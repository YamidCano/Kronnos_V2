<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class UserView extends Component
{
    //Paginacion
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    //Declaramos variables publicas
    public $perPage = 25;
    public $search, $search1, $city, $identification, $password, $password_confirmation, $selecRole;
    public $user, $user_id, $name, $last_name, $email, $phone, $address, $status = 0;
    public $Role, $Role_id, $role;
    public $permission_check = [];

    //Actualizamos la vista
    protected $listeners = ['statusActivate', 'statusDeactivate', 'addPermission'];

    public function render()
    {
        //declarmos una variables y tramos los datos de la tabla
        $usuarios = User::all();
        $users =  User::query()
            // ->where('name', 'like', "%{$this->search}%")
            ->when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->where('name', 'like', "%{$this->search}%")
                        ->orWhere('last_name', 'like', "%{$this->search}%")
                        ->orWhere('email', 'like', "%{$this->search}%")
                        ->orWhere('phone', 'like', "%{$this->search}%")
                        ->orWhere('identification', 'like', "%{$this->search}%");
                });
            })
            ->paginate($this->perPage);

        //Retornamos la vista y volcamos los datos
        return view('livewire.user.user-view', compact('users', 'usuarios'));
    }

    //Decleramos campos sin validar
    function rules()
    {
        return [
            'name' => '',
            'last_name' => '',
            'identification' => '',
            'email' => '',
            'phone' => '',
            'city' => '',
            'address' => '',
            'status' => '',
            'selecRole' => '',
            'password' => '',
            'password_confirmation' => '',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    //Traer Informacion al cargar  la vista
    public function mount()
    {
        $this->roles = Role::orderBy('name')->get();
    }

    //Creamos el registro
    public function save()
    {
        //Validamos los campos
        $this->validate([
            'name' => 'required|min:3|max:256|regex:/^[\pL\s\-]+$/u',
            'last_name' => 'required|min:3|max:256|regex:/^[\pL\s\-]+$/u',
            'identification' => 'required|min:7|max:10|unique:App\Models\User,identification',
            'email' => 'required|min:3|max:50|email|unique:App\Models\User,email',
            'phone' => 'required|min:3|max:11',
            'city' => 'required|min:3|max:256',
            'address' => 'required',
            'status' => 'required',
            'selecRole' => 'required',
            'password' => 'required|min:6',
            'password_confirmation' => 'same:password',
        ]);

        //Guardamos los registros
        $users = User::create([
            'name' => $this->name,
            'last_name' => $this->last_name,
            'identification' => $this->identification,
            'email' => $this->email,
            'phone' => $this->phone,
            'city' => $this->city,
            'address' => $this->address,
            'status' => $this->status,
            'password' => bcrypt($this->password),
            'id_roles' => $this->selecRole,
        ]);

        //Asignamos al usuario el rol selecionado
        $users->assignRole([$this->selecRole]);
        //Cerramos la ventana modal
        $this->emit('Store');
        //Limpiamos validaciones
        $this->resetErrorBag();
        $this->resetValidation();
        //Limpiamos Campos
        $this->reset(['last_name', 'name', 'email', 'phone', 'city', 'address', 'identification', 'password', 'password_confirmation', 'selecRole']);
        //Enviamos el mensaje de confirmacion
        $this->emit('alert', 'Registro creada sastifactoriamente');
    }

    //Tramos los datos al editar y lo volcamos en variables
    public function edit(User $user)
    {
        $this->user = $user;
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->last_name = $user->last_name;
        $this->identification = $user->identification;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->address = $user->address;
        $this->status = $user->status;
        $this->selecRole = $user->id_roles;
        $this->city = $user->city;
    }

    //Actualizamos formulario de edicion
    public function update()
    {
        //Validamos los campos
        $this->validate([
            'name' => 'required|min:3|max:256',
            'last_name' => 'required|min:3|max:256',
            'identification' => 'required|min:7|max:10|unique:App\Models\User,identification,' . optional($this->user)->id,
            'email' => 'required|min:3|max:50|email|unique:App\Models\User,email,' . optional($this->user)->id,
            'phone' => 'required|min:3|max:11',
            'city' => 'required|min:3|max:256',
            'address' => 'required',
            'selecRole' => 'required',
            'password_confirmation' => 'same:password',
        ]);

        //Guardamos los registros
        if ($update = User::where('id', $this->user->id)->first()) {
            $update->name = $this->name;
            $update->last_name = $this->last_name;
            $update->identification = $this->identification;
            $update->email = $this->email;
            $update->phone = $this->phone;
            $update->address = $this->address;
            $update->city = $this->city;
            $update->id_roles = $this->selecRole;

            if (!is_null($this->password)) {
                $update->password = Hash::make($this->password);
            }
            //Asignamos al usuario el rol selecionado
            $update->syncRoles([$this->selecRole]);

            $update->save();
        }
        //Cerramos la ventana modal
        $this->emit('update');
        //Limpiamos validaciones
        $this->resetErrorBag();
        $this->resetValidation();
        //Limpiamos Campos
        $this->reset(['last_name', 'name', 'email', 'phone', 'city', 'address', 'identification', 'password', 'password_confirmation', 'selecRole']);
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
        $this->reset(['last_name', 'name', 'email', 'phone', 'city', 'address', 'identification', 'password', 'password_confirmation', 'selecRole']);
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

    public function addPermission(User $puser)
    {
        $permissions = Permission::orderBy('name')->get();
        $this->puser = $puser;

        $havePermission = $puser->getPermissionsViaRoles();

        foreach($permissions as $p){
            if($puser->hasPermissionTo($p)){
                $this->permission_check[$p->name]['check'] = true;
            }else {
                $this->permission_check[$p->name]['check'] = false;
            }
            $this->permission_check[$p->name]['id'] = $p->id;
        }
    }

    public function addPermissionKey($permission)
    {
        if(!$this->puser->hasPermissionTo($permission)){
            $this->puser->givePermissionTo($permission);
        } else {
            $this->puser->revokePermissionTo($permission);
        }
    }

    public function clean()
    {
        $this->reset(['search']);
    }
}

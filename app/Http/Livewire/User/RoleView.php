<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Spatie\Permission\Models\Permission;


class RoleView extends Component
{
    public $Role, $name, $Role_id, $role, $guard_name = 'web';
    public $permission_check = [];

    protected $listeners = ['deleteRole', 'addPermission', 'deletePermission'];

    function rules() {
        return [
            'name' => '',
        ];
    }

    public function render()
    {
        $roles = Role::orderBy('name')->get();
        $permissions = Permission::orderBy('name')->get();

        $roles = $roles->each( function ($role) {
            $role->count_user = User::role($role->name)->count();
        });

        $permissions = $permissions->each( function ($permission) {
            $permission->count_user = User::permission($permission->name)->count();
        });

        return view('livewire.user.role-view', compact('roles', 'permissions'));
    }

    public function edit($id)
    {
        $this->Role = Role::find($id);
        $this->Role_id = $this->Role->id;
        $this->name = $this->Role->name;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|min:3|max:256|unique:Spatie\Permission\Models\Role,name,'. optional($this->Role)->id,
        ]);
        $Role = Role::find($this->Role_id);
        $Role->update([
            'name' => $this->name,
        ]);
        $this->emit('update');
        $this->reset(['name']);
        $this->resetErrorBag();
        $this->resetValidation();
        $this->emit('alert', 'Rol Actualizada sastifactoriamente');
    }

    public function save(){

        $this->validate([
            'name' => 'required|min:3|max:256|unique:Spatie\Permission\Models\Role,name,',
        ]);

        Role::create([
            'name' => $this->name,
            'guard_name' => $this->guard_name,
        ]);

        $this->emit('Store');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset(['name']);
        $this->emit('alert', 'Rol creada sastifactoriamente');
    }

    public function deleteRole(Role $Role)
    {
        $Role->delete();
    }

    public function deletePermission(Permission $Permission)
    {
        $Permission->delete();
    }

    public function close(){
        $this->reset(['name']);
        $this->emit('updateModal');
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function addPermission(Role $role)
    {
        $permissions = Permission::orderBy('name')->get();
        $this->role = $role;

        $havePermission = $role->permissions()->get();

        foreach($permissions as $permission){
            if($havePermission->contains($permission)){
                $this->permission_check[$permission->name]['check'] = true;
            }else {
                $this->permission_check[$permission->name]['check'] = false;
            }
            $this->permission_check[$permission->name]['id'] = $permission->id;
        }
    }

    public function addPermissionKey($permission)
    {
        if(!$this->role->hasPermissionTo($permission)){
            $this->role->givePermissionTo($permission);
        } else {
            $this->role->revokePermissionTo($permission);
        }

    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $Administrador = User::factory()->create([
            'name' => 'Kronnos',
            'last_name' => 'Business',
            'identification' => '9005213556',
            'email' => 'admin@kronnos.com',
            'phone' => '3215555555',
            'address' => 'Bogota',
            'city' => 'Bogota DC',
            'password' => Hash::make('123456'),
        ]);

        $admin = Role::create(['name' => 'Administrador']);
        $usuarios = Role::create(['name' => 'Usuario']);
        $RoleyPermisos = Role::create(['name' => 'Role y Permisos']);

        //crud de usuarios
        $permission = [
            '- Tabla',
            '- Crear',
            '- Ver',
            '- Editar',
            '- Desativar',
            '- Eliminar',
            '- Permisos',
        ];

        foreach (Role::all() as $rol){
            foreach ($permission as $p) {
                // if ($rol->name == 'administrador') $rol->name = 'usuario';
                Permission::create(['name' => "{$rol->name} $p"]);
            }
        }

        $admin->syncPermissions(Permission::all());
        $usuarios->syncPermissions(Permission::where('name', 'like', "%Usuario%")->get());
        $RoleyPermisos->syncPermissions(Permission::where('name', 'like', "%Role y Permisos%")->get());

        $Administrador->assignRole('Administrador');
    }
}

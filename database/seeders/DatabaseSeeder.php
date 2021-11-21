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
            'first_name' => 'Kronnos',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
        ]);

        $admin = Role::create(['name' => 'Administrador']);
        $usuarios = Role::create(['name' => 'Usuario']);

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

        $Administrador->assignRole('Administrador');
    }
}

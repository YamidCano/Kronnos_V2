<?php

namespace Database\Seeders;

use App\Models\brands;
use App\Models\clients;
use App\Models\invoice;
use App\Models\invoice_details;
use App\Models\paymentMode;
use App\Models\product_category;
use App\Models\products;
use App\Models\providers;
use App\Models\shopping;
use App\Models\shopping_details;
use App\Models\taxes;
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


        $marca = new taxes();
        $marca->name = "No Aplica";
        $marca->tax_rate = "0";
        $marca->save();

        $marca = new taxes();
        $marca->name = "Iva";
        $marca->tax_rate = "19";
        $marca->save();

        $marca = new paymentMode();
        $marca->name = "Efectivo";
        $marca->save();

        $marca = new paymentMode();
        $marca->name = "Tarjeta";
        $marca->save();

        $marca = new paymentMode();
        $marca->name = "Consignación";
        $marca->save();

        $marca = new brands();
        $marca->name = "Marca A";
        $marca->save();

        $marca = new brands();
        $marca->name = "Marca B";
        $marca->save();

        $marca = new brands();
        $marca->name = "Marca C";
        $marca->save();

        $marca = new product_category();
        $marca->name = "Categoría A";
        $marca->save();

        $marca = new product_category();
        $marca->name = "Categoría B";
        $marca->save();

        $marca = new product_category();
        $marca->name = "Categoría C";
        $marca->save();

        $provider = new providers();
        $provider->name = "Proveedor A";
        $provider->city = "Bogota";
        $provider->address = "Calle";
        $provider->email = "proveedora@proveedora.com";
        $provider->phone = "32145675456";
        $provider->nit = "900521344";
        $provider->status = "0";
        $provider->save();

        $provider = new providers();
        $provider->name = "Proveedor B";
        $provider->city = "Bogota";
        $provider->address = "Calle";
        $provider->email = "proveedorb@proveedorb.com";
        $provider->phone = "32145675457";
        $provider->nit = "900521345";
        $provider->status = "0";
        $provider->save();

        $Administrador = User::factory()->create([
            'name' => 'Administrador',
            'last_name' => 'Kronnos',
            'identification' => '9005213556',
            'email' => 'admin@kronnos.com',
            'phone' => '3215555555',
            'address' => 'Bogota',
            'city' => 'Bogota DC',
            'password' => Hash::make('VUyOvScy'),
        ]);
        $Vendedor = User::factory()->create([
            'name' => 'Vendedor',
            'last_name' => 'Kronnos',
            'identification' => '9005213557',
            'email' => 'vendedor@kronnos.com',
            'phone' => '3215555555',
            'address' => 'Bogota',
            'city' => 'Bogota DC',
            'password' => Hash::make('VUyOvScy'),
        ]);

        $Usuario = User::factory()->create([
            'name' => 'Pepito',
            'last_name' => 'Perez',
            'identification' => '9005213558',
            'email' => 'Perez@kronnos.com',
            'phone' => '3215555555',
            'address' => 'Bogota',
            'city' => 'Bogota DC',
            'password' => Hash::make('VUyOvScy'),
        ]);

        $provider = new clients();
        $provider->name = "Juan Carlos";
        $provider->city = "Bogota";
        $provider->address = "Calle";
        $provider->email = "jcarlos@cliente.com";
        $provider->phone = "3214567585";
        $provider->identification = "5632147";
        $provider->status = "0";
        $provider->save();

        $provider = new clients();
        $provider->name = "Maria Camila";
        $provider->city = "Bogota";
        $provider->address = "Calle";
        $provider->email = "mcamila@cliente.com";
        $provider->phone = "3214545879";
        $provider->identification = "35448568";
        $provider->status = "0";
        $provider->save();

        $admin = Role::create(['name' => 'Administrador']);
        $usuarios = Role::create(['name' => 'Usuario']);
        $RoleyPermisos = Role::create(['name' => 'Role y Permisos']);
        $productos = Role::create(['name' => 'Producto']);
        $proveedor = Role::create(['name' => 'Proveedor']);
        $ProductCategory = Role::create(['name' => 'Categoria-Producto']);
        $Inventorie = Role::create(['name' => 'Inventorie']);
        $Brands = Role::create(['name' => 'Brands']);
        $Shopping = Role::create(['name' => 'Shopping']);
        $Taxes = Role::create(['name' => 'Taxes']);
        $PaymentMode = Role::create(['name' => 'Payment-Mode']);
        $OutPayment  = Role::create(['name' => 'OutPayment']);
        $Invoice  = Role::create(['name' => 'Invoice']);
        $clients  = Role::create(['name' => 'clients']);

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
        $productos->syncPermissions(Permission::where('name', 'like', "%Producto%")->get());
        $proveedor->syncPermissions(Permission::where('name', 'like', "%Proveedor%")->get());
        $ProductCategory->syncPermissions(Permission::where('name', 'like', "%Categoria-Producto%")->get());
        $Inventorie->syncPermissions(Permission::where('name', 'like', "%Inventorie%")->get());
        $Brands->syncPermissions(Permission::where('name', 'like', "%Brands%")->get());
        $Shopping->syncPermissions(Permission::where('name', 'like', "%Shopping%")->get());
        $Taxes->syncPermissions(Permission::where('name', 'like', "%Taxes%")->get());
        $PaymentMode->syncPermissions(Permission::where('name', 'like', "%Payment-Mode%")->get());
        $OutPayment->syncPermissions(Permission::where('name', 'like', "%OutPayment%")->get());
        $Invoice->syncPermissions(Permission::where('name', 'like', "%Invoice%")->get());
        $clients->syncPermissions(Permission::where('name', 'like', "%clients%")->get());

        $Administrador->assignRole('Administrador');
        $Vendedor->assignRole('Invoice');
        $Usuario->assignRole('Usuario');

        $provider = new products();
        $provider->name = "Producto A";
        $provider->code = "45634565";
        $provider->price = "45000";
        $provider->price_sale = "54000";
        $provider->id_product_categories = "1";
        $provider->id_brands = "2";
        $provider->description = "N/A";
        $provider->status = "0";
        $provider->stock = "20";
        $provider->save();

        $provider = new products();
        $provider->name = "Producto B";
        $provider->code = "986542344";
        $provider->price = "50000";
        $provider->price_sale = "59000";
        $provider->id_product_categories = "3";
        $provider->id_brands = "1";
        $provider->description = "N/A";
        $provider->status = "0";
        $provider->stock = "40";
        $provider->save();

        $provider = new products();
        $provider->name = "Producto C";
        $provider->code = "985433244";
        $provider->price = "25000";
        $provider->price_sale = "36000";
        $provider->id_product_categories = "2";
        $provider->id_brands = "2";
        $provider->description = "N/A";
        $provider->status = "0";
        $provider->stock = "60";
        $provider->save();

        $provider = new shopping();
        $provider->invoice_number = "FC-001";
        $provider->slug = "FC-001";
        $provider->id_provider = "1";
        $provider->date = "2022-06-23";
        $provider->order_status = "0";
        $provider->id_taxe = "2";
        $provider->note = "N/A";
        $provider->Subtotal = "1740000";
        $provider->total = "2070600";
        $provider->save();

        $provider = new shopping_details();
        $provider->id_shoppings = "1";
        $provider->id_products = "1";
        $provider->quantity = "22";
        $provider->price = "45000";
        $provider->total = "990000";
        $provider->save();

        $provider = new shopping_details();
        $provider->id_shoppings = "1";
        $provider->id_products = "2";
        $provider->quantity = "15";
        $provider->price = "50000";
        $provider->total = "750000";
        $provider->save();

        $provider = new shopping();
        $provider->invoice_number = "FC-002";
        $provider->slug = "FC-002";
        $provider->id_provider = "2";
        $provider->date = "2022-06-23";
        $provider->order_status = "0";
        $provider->id_taxe = "2";
        $provider->note = "N/A";
        $provider->Subtotal = "5000000";
        $provider->total = "595000";
        $provider->save();

        $provider = new shopping_details();
        $provider->id_shoppings = "2";
        $provider->id_products = "3";
        $provider->quantity = "20";
        $provider->price = "25000";
        $provider->total = "500000";
        $provider->save();

        $provider = new invoice();
        $provider->invoice_number = "FV-001";
        $provider->slug = "FV-001";
        $provider->id_seller = "1";
        $provider->id_client = "2";
        $provider->date = "2022-06-23";
        $provider->order_status = "0";
        $provider->id_taxe = "2";
        $provider->note = "N/A";
        $provider->Subtotal = "5000000";
        $provider->total = "595000";
        $provider->save();

        $provider = new invoice_details();
        $provider->id_invoice = "1";
        $provider->id_product = "3";
        $provider->quantity = "20";
        $provider->price = "25000";
        $provider->total = "500000";
        $provider->save();

        $provider = new invoice();
        $provider->invoice_number = "FV-002";
        $provider->slug = "FV-002";
        $provider->id_seller = "2";
        $provider->id_client = "1";
        $provider->date = "2022-06-23";
        $provider->order_status = "0";
        $provider->id_taxe = "2";
        $provider->note = "N/A";
        $provider->Subtotal = "2580000";
        $provider->total = "3070200";
        $provider->save();

        $provider = new invoice_details();
        $provider->id_invoice = "2";
        $provider->id_product = "1";
        $provider->quantity = "15";
        $provider->price = "54000";
        $provider->total = "810000";
        $provider->save();

        $provider = new invoice_details();
        $provider->id_invoice = "2";
        $provider->id_product = "2";
        $provider->quantity = "15";
        $provider->price = "59000";
        $provider->total = "1770000";
        $provider->save();
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\providers;
use Livewire\WithPagination;
use App\Models\products;
use App\Models\product_category;
use Livewire\WithFileUploads;

class ProductsView extends Component
{
    //Paginacion
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    //Declaramos variables publicas
    public $perPage = 25;
    public $search, $name, $selectprovider, $selectcategory, $description, $photo, $Updatephotos, $photos;
    public $providers, $product_category, $providerNit, $idenImg;

    //Actualizamos la vista
    protected $listeners = ['destroy'];

    public function render()
    {
        $products =  products::query()
            ->when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->where('name', 'like', "%{$this->search}%")
                        ->orWhere('description', 'like', "%{$this->search}%")
                        ->orWhere('description', 'like', "%{$this->search}%");
                });
            })
            ->paginate($this->perPage);

        return view('livewire.products-view', compact('products'));
    }

    //Decleramos campos sin validar
    function rules()
    {
        return [
            'name' => '',
            'selectcategory' => '',
            'selectprovider' => '',
            'photo' => '',
            'description' => '',
        ];
    }

    //Traer Informacion al cargar  la vista
    public function mount()
    {
        $this->providers = providers::orderBy('name')->get();
        $this->product_category = product_category::orderBy('name')->get();
        $this->idenImg = rand();
    }

    public function updatedVariableQueCambia()
    {
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    //Creamos el registro
    public function save()
    {
        //Validamos los campos
        $this->validate([
            'name' => 'required|min:3|max:256',
            'selectcategory' => 'required',
            'selectprovider' => 'required',
            'photo' => 'required|image|max:2048',
            'description' => 'required|min:7|max:10',
        ]);

        $img = $this->photo->store('imgProduct', 'public');

        //Guardamos los registros
        products::create([
            'name' => $this->name,
            'id_provider' => $this->selectprovider,
            'id_product_categories' => $this->selectcategory,
            'photo' => $img,
            'description' => $this->description,
        ]);

        $this->idenImg = rand();

        //Cerramos la ventana modal
        $this->emit('Store');
        //Limpiamos validaciones
        $this->resetErrorBag();
        $this->resetValidation();
        //Limpiamos Campos
        $this->reset(['name', 'selectprovider', 'selectcategory', 'description', 'photo', 'providerNit', 'idenImg']);
        //Enviamos el mensaje de confirmacion
        $this->emit('alert', 'Registro creada sastifactoriamente');
    }

    //Tramos los datos al editar y lo volcamos en variables
    public function edit(products $product)
    {
        $this->product = $product;
        $this->product_id = $product->id;
        $this->name = $product->name;
        $this->selectprovider = $product->id_provider;
        $this->selectcategory = $product->id_product_categories;
        $this->Updatephotos = $product->photo;
        $this->description = $product->description;
    }

    //Actualizamos formulario de edicion
    public function update()
    {
        //Validamos los campos
        $this->validate([
            'name' => 'required|min:3|max:256',
            'selectcategory' => 'required',
            'selectprovider' => 'required',
            'photo' => 'required|image|max:2048',
            'description' => 'required|min:7|max:10',
        ]);

        $img = $this->photos->store('imgProduct', 'public');

        $product = products::find($this->provider_id);
        $product->update([
            'name' => $this->name,
            'id_provider' => $this->selectprovider,
            'id_product_categories' => $this->selectcategory,
            'photo' => $img,
            'description' => $this->description,
        ]);

        //Guardamos los registros
        if ($update = products::where('id', $this->product->id)->first()) {
            $update->name = $this->name;
            $update->id_provider = $this->selectprovider;
            $update->id_product_categories = $this->selectcategory;
            $update->description = $this->description;

            if (!is_null($this->password)) {
                // $update->password = Hash::make($this->password);
            }
        }
        $this->reset(['name', 'selectprovider', 'selectcategory', 'description', 'photo', 'providerNit', 'photos', 'Updatephotos']);
        $this->idenImg = rand();
        $this->emit('update');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->emit('alert', 'Registro Actualizada sastifactoriamente');
    }

    public function destroy(products $provider)
    {
        $provider->delete();
    }

    //Cerrar una ventana modal
    public function close()
    {
        //Limpiamos validaciones
        $this->resetErrorBag();
        $this->resetValidation();
        //Limpiamos Campos
        $this->reset(['name', 'selectprovider', 'selectcategory', 'description', 'photo', 'providerNit', 'photos', 'Updatephotos']);
        $this->idenImg = rand();
    }

    public function cancelimg()
    {
        //Limpiamos validaciones
        $this->resetErrorBag();
        $this->resetValidation();
        //Limpiamos Campos
        $this->reset(['photo', 'photos', 'Updatephotos']);

        $this->idenImg = rand();
    }
}

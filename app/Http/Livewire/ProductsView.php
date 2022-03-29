<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\providers;
use Livewire\WithPagination;
use App\Models\products;
use App\Models\product_category;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class ProductsView extends Component
{
    //Paginacion
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    //Declaramos variables publicas
    public $perPage = 25, $descriptionLong, $Specifications, $status = 0, $slider = 0, $stock, $price, $slug;
    public $search, $name, $selectprovider, $selectcategory, $description, $photo, $Updatephotos, $photos;
    public $providers, $product_category, $providerNit, $idenImg, $providerNit2, $providersNit, $code, $modalPhoto;

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

    public $updating;

    //Decleramos campos sin validar
    public function rules(): array
    {
        if ($this->updating == true) {
            return [
                'name' => 'required|min:3|max:256|unique:App\Models\products,name,' . optional($this->product)->id,
                'selectcategory' => 'required',
                'code' => 'required|unique:App\Models\products,code,' . optional($this->product)->id,
                'selectprovider' => 'required',
                'photo' => '',
                'description' => 'required',
                'descriptionLong' => 'required',
                'Specifications' => 'required',
                'status' => 'required',
                'slider' => 'required',
                'price' => 'required',
            ];
        }

        return [
            'name' => 'required|min:3|max:256|unique:App\Models\products,name,',
            'selectcategory' => 'required',
            'code' => 'required|unique:App\Models\products,code,',
            'selectprovider' => 'required',
            'photo' => 'required|image|max:2048',
            'description' => 'required',
            'descriptionLong' => 'required',
            'Specifications' => 'required',
            'status' => 'required',
            'slider' => 'required',
            'price' => 'required',
        ];
    }

    //Traer Informacion al cargar  la vista
    public function mount()
    {
        $this->providers = providers::orderBy('name')->get();
        $this->product_category = product_category::orderBy('name')->get();
        $this->idenImg = rand();
    }

    public function updatedselectprovider()
    {
        $nit = providers::find($this->selectprovider);
        $this->providerNit = $nit->nit;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    //Creamos el registro
    public function save()
    {
        //Validamos los campos
        $this->validate();

        $img = $this->photo->store('imgProduct', 'public');

        $this->createslug();

        //Guardamos los registros
        products::create([
            'name' => $this->name,
            'id_provider' => $this->selectprovider,
            'code' => $this->code,
            'id_product_categories' => $this->selectcategory,
            'photo' => $img,
            'description' => $this->description,
            'descriptionLong' => $this->descriptionLong,
            'Specifications' => $this->Specifications,
            'status' => $this->status,
            'slider' => $this->slider,
            'price' => $this->price,
            'slug' => $this->slug,
        ]);

        $this->idenImg = rand();

        //Cerramos la ventana modal
        $this->emit('Store');
        //Limpiamos validaciones
        $this->resetErrorBag();
        $this->resetValidation();
        //Limpiamos Campos
        $this->reset(['name', 'code', 'selectprovider', 'selectcategory', 'description', 'descriptionLong', 'Specifications', 'status', 'slider', 'price', 'slug', 'photo', 'providerNit', 'idenImg', 'updating']);
        //Enviamos el mensaje de confirmacion
        $this->emit('alert', 'Registro creada sastifactoriamente');
    }

    //Tramos los datos al editar y lo volcamos en variables
    public function edit(products $product)
    {
        $this->updating = true;
        $this->product = $product;
        $this->product_id = $product->id;
        $this->name = $product->name;
        $this->code = $product->code;
        $this->descriptionLong = $product->descriptionLong;
        $this->Specifications = $product->Specifications;
        $this->status = $product->status;
        $this->slider = $product->slider;
        $this->price = $product->price;
        $this->selectprovider = $product->id_provider;
        $this->selectcategory = $product->id_product_categories;
        $this->Updatephotos = $product->photo;
        $this->description = $product->description;

        $providers = providers::find($product->id_provider);
        $this->providersNit = $providers->nit;
    }

    public function modalPhoto(products $product)
    {
        $this->product = $product;
        $this->modalPhoto = $product->photo;
    }

    //Actualizamos formulario de edicion
    public function update()
    {
        //Validamos los campos
        // $this->validate();

        if ($this->photos == !null) {
            $img = $this->photos->store('imgProduct', 'public');
        }

        if ($this->status == null ) {
            $this->status = null;
        }

        $this->createslug();

        if ($update = products::where('id', $this->product_id)->first()) {
            $update->name = $this->name;
            $update->code = $this->code;
            $update->id_provider = $this->selectprovider;
            $update->id_product_categories = $this->selectcategory;
            $update->description = $this->description;
            $update->descriptionLong = $this->descriptionLong;
            $update->Specifications = $this->Specifications;
            $update->status = $this->status;
            $update->slider = $this->slider;
            $update->price = $this->price;
            $update->slug = $this->slug;

            if ($this->photos == !null) {
                $update->photo = $img;
            } else {
                $update->photo = $this->Updatephotos;
            }

            $update->save();
        }


        $this->reset(['name', 'code', 'selectprovider', 'selectcategory', 'description', 'descriptionLong', 'Specifications', 'status', 'slider', 'price', 'slug', 'photo', 'providerNit', 'idenImg', 'updating']);
        $this->idenImg = rand();
        $this->emit('update');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->emit('alert', 'Registro Actualizada sastifactoriamente');
    }

    public function destroy(products $products)
    {
        $products->delete();
    }

    //Cerrar una ventana modal
    public function close()
    {
        //Limpiamos validaciones
        $this->resetErrorBag();
        $this->resetValidation();
        //Limpiamos Campos
        $this->reset(['name', 'code', 'selectprovider', 'selectcategory', 'description', 'descriptionLong', 'Specifications', 'status', 'slider', 'price', 'slug', 'photo', 'providerNit', 'idenImg', 'updating']);
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

    private function createslug()
    {

        $this->slug = SlugService::createSlug(products::class, 'slug', $this->name);
    }
}

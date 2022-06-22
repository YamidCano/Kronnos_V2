<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\providers;
use App\Models\brands;
use Livewire\WithPagination;
use App\Models\products;
use App\Models\inventories;
use App\Models\product_category;
use App\Models\shopping_details;
use Livewire\WithFileUploads;
use Cviebrock\EloquentSluggable\Services\SlugService;

class ProductsView extends Component
{
    //Paginacion
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    //Declaramos variables publicas
    public $perPage = 25,  $status = 0, $stock, $price, $slug;
    public $search, $name, $selectbrands, $selectcategory, $description, $priceSale = 0;
    public $photo, $Updatephotos, $photos;
    public $product_category, $idenImg, $code, $modalPhoto;
    public $createslug;
    public $updating = false;

    //Actualizamos la vista
    protected $listeners = ['destroy'];

    public function render()
    {

        $products =  products::query()
            ->when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->where('name', 'like', "%{$this->search}%")
                        ->orWhere('code', 'like', "%{$this->search}%")
                        ->orWhere('price', 'like', "%{$this->search}%")
                        ->orWhere('price_sale', 'like', "%{$this->search}%");
                });
            })
            ->paginate($this->perPage);

        $products->each(function ($item) {
            $inventories = inventories::where('id_product', $item->id)->count();
            $shopping_details = shopping_details::where('id_products', $item->id)->count();
            return $item->count_products = $shopping_details + $inventories;
        });

        return view('livewire.products-view', compact('products'));
    }

    //Decleramos campos sin validar
    public function rules(): array
    {
        if ($this->updating) {
            return [
                'name' => 'required|min:3|max:256|unique:App\Models\products,name,' . optional($this->product)->id,
                'selectcategory' => 'required',
                'code' => 'required|unique:App\Models\products,code,' . optional($this->product)->id,
                'selectbrands' => 'required',
                'photo' => '',
                'description' => 'required',
                'status' => 'required',
                'price' => 'required',
                'priceSale' => 'required',
                'stock' => 'required',
            ];
        }

        return [
            'name' => 'required|min:3|max:256|unique:App\Models\products,name,',
            'selectcategory' => 'required',
            'code' => 'required|unique:App\Models\products,code,',
            'selectbrands' => 'required',
            'photo' => 'required|image|max:2048',
            'description' => 'required',
            'status' => 'required',
            'price' => 'required',
            'priceSale' => 'required',
            'stock' => 'required',
        ];
    }

    //Traer Informacion al cargar  la vista
    public function mount()
    {
        $this->brands = brands::orderBy('name')->get();
        $this->product_category = product_category::orderBy('name')->get();
        $this->idenImg = rand();
    }

    public function codeg()
    {
        $this->code = rand(00000000, 999999999);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function resetCV()
    {
        $this->reset(['name', 'stock', 'code', 'selectbrands', 'photo', 'description', 'status',  'price', 'priceSale', 'slug', 'photo', 'idenImg', 'updating']);
        $this->idenImg = rand();
        $this->resetErrorBag();
        $this->resetValidation();
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
            'id_brands' => $this->selectbrands,
            'code' => $this->code,
            'id_product_categories' => $this->selectcategory,
            'photo' => $img,
            'description' => $this->description,
            'status' => $this->status,
            'price' => $this->price,
            'price_sale' => $this->priceSale,
            'slug' => $this->slug,
            'stock' => $this->stock,
        ]);

        //Limpiar campos, Validaciones
        $this->resetCV();

        //Cerramos la ventana modal
        $this->emit('Store');

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
        $this->status = $product->status;
        $this->stock = $product->stock;
        $this->price = $product->price;
        $this->priceSale = $product->price_sale;
        $this->selectbrands = $product->id_brands;
        $this->selectcategory = $product->id_product_categories;
        $this->Updatephotos = $product->photo;
        $this->description = $product->description;
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
        $this->validate();

        if ($this->photos == !null) {
            $img = $this->photos->store('imgProduct', 'public');
        }

        $this->createslug();

        if ($update = products::where('id', $this->product_id)->first()) {
            $update->name = $this->name;
            $update->code = $this->code;
            $update->id_brands = $this->selectbrands;
            $update->id_product_categories = $this->selectcategory;
            $update->description = $this->description;
            $update->status = $this->status;
            $update->price = $this->price;
            $update->price_sale = $this->priceSale;
            $update->slug = $this->slug;

            if ($this->photos == !null) {
                $update->photo = $img;
            } else {
                $update->photo = $this->Updatephotos;
            }

            $update->save();
        }

        //Limpiar campos, Validaciones
        $this->resetCV();

        $this->emit('update');
        $this->emit('alert', 'Registro Actualizada sastifactoriamente');
    }

    public function destroy(products $products)
    {
        $products->delete();
        //Limpiar campos, Validaciones
        $this->resetCV();
    }

    //Cerrar una ventana modal
    public function close()
    {
        //Limpiar campos, Validaciones
        $this->resetCV();
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

    public function clean()
    {
        //Limpiamos Campos
        $this->reset(['search']);
    }
}

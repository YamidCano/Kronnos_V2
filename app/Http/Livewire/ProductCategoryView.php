<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\product_category;
use App\Models\products;
use Livewire\WithPagination;

class ProductCategoryView extends Component
{
    //Paginacion
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    //Declaramos variables publicas
    public $perPage = 25;
    public $search, $name, $category_id, $category;
    public $updating = false;

    //Actualizamos la vista
    protected $listeners = ['destroy'];

    public function render()
    {
        $categories =  product_category::query()
            ->where('name', 'like', "%{$this->search}%")
            ->paginate($this->perPage);

        $categories->each(function ($item) {
            return $item->count_category = products::where('id_product_categories', $item->id)->count();
        });

        return view('livewire.product-category-view', compact('categories'));
    }

    //Decleramos campos sin validar
    public function rules(): array
    {
        if ($this->updating == true) {
            return [
                'name' => 'required|min:3|max:256|unique:App\Models\product_category,name,' . optional($this->category)->id,
            ];
        }

        return [
            'name' => 'required|min:3|max:256|unique:App\Models\product_category,name,',
        ];
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

        //Guardamos los registros
        product_category::create([
            'name' => $this->name,
        ]);

        //Cerramos la ventana modal
        $this->emit('Store');
        //Limpiamos validaciones
        $this->resetErrorBag();
        $this->resetValidation();
        //Limpiamos Campos
        $this->reset(['name']);
        //Enviamos el mensaje de confirmacion
        $this->emit('alert', 'Registro creada sastifactoriamente');
    }

    //Tramos los datos al editar y lo volcamos en variables
    public function edit(product_category $category)
    {
        $this->updating = true;
        $this->category = $category;
        $this->category_id = $category->id;
        $this->name = $category->name;
    }

    //Actualizamos formulario de edicion
    public function update()
    {
        //Validamos los campos
        $this->validate();

        $category = product_category::find($this->category_id);
        $category->update([
            'name' => $this->name,
        ]);
        $this->reset(['name']);
        $this->emit('update');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->emit('alert', 'Registro Actualizada sastifactoriamente');
    }

    public function destroy(product_category $category)
    {
        $category->delete();
        //Limpiamos validaciones
        $this->resetErrorBag();
        $this->resetValidation();
        //Limpiamos Campos
        $this->reset(['name']);
    }

    //Cerrar una ventana modal
    public function close()
    {
        //Limpiamos validaciones
        $this->resetErrorBag();
        $this->resetValidation();
        //Limpiamos Campos
        $this->reset(['name']);
    }

    public function clean()
    {
        $this->reset(['search']);
    }
}

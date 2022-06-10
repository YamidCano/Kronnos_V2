<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\brands;
use App\Models\products;
use Livewire\WithPagination;


class BrandsView extends Component
{
        //Paginacion
        use WithPagination;
        protected $paginationTheme = 'bootstrap';

        //Declaramos variables publicas
        public $perPage = 25;
        public $search, $name, $brand_id, $brand;
        public $updating = false;

        //Actualizamos la vista
        protected $listeners = ['destroy'];

        public function render()
        {
            $brands =  brands::query()
                ->where('name', 'like', "%{$this->search}%")
                ->paginate($this->perPage);

            $brands->each(function ($item) {
                return $item->count_brand = products::where('id_brands', $item->id)->count();
            });

            return view('livewire.brands-view', compact('brands'));
        }

        //Decleramos campos sin validar
        public function rules(): array
        {
            if ($this->updating == true) {
                return [
                    'name' => 'required|min:3|max:256|unique:App\Models\brands,name,' . optional($this->brand)->id,
                ];
            }

            return [
                'name' => 'required|min:3|max:256|unique:App\Models\brands,name,',
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
            brands::create([
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
        public function edit(brands $brand)
        {
            $this->updating = true;
            $this->brand = $brand;
            $this->brand_id = $brand->id;
            $this->name = $brand->name;
        }

        //Actualizamos formulario de edicion
        public function update()
        {
            //Validamos los campos
            $this->validate();

            $brands = brands::find($this->brand_id);
            $brands->update([
                'name' => $this->name,
            ]);
            $this->reset(['name']);
            $this->emit('update');
            $this->resetErrorBag();
            $this->resetValidation();
            $this->emit('alert', 'Registro Actualizada sastifactoriamente');
        }

        public function destroy(brands $brand)
        {
            $brand->delete();
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

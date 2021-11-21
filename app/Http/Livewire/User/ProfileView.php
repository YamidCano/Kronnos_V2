<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Darbaoui\Avatar\Facades\Avatar;

class ProfileView extends Component
{
    //Paginacion
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    //Declaramos variables publicas
    public $search, $search1, $city, $identification , $password, $password_confirmation;
    public $user, $user_id, $name,  $first_name, $last_name, $email, $phone, $address, $status = 0;

    //Actualizamos la vista
    protected $listeners = ['statusActivate', 'statusDeactivate'];

    public function render()
    {

        return view('livewire.user.profile-view');
    }

    public function mount()
    {

        $this->user_id = auth()->user()->id;
        $this->first_name = auth()->user()->first_name;
        $this->last_name = auth()->user()->last_name;
        $this->identification = auth()->user()->identification;
        $this->email =auth()->user()->email;
        $this->phone = auth()->user()->phone;
        $this->address = auth()->user()->address;
        $this->city = auth()->user()->city;

        $user = User::find($this->user_id);
        $this->user = $user;
    }

        //Decleramos campos sin validar
        function rules()
        {
            return [
                'first_name' => 'required|min:3|max:256',
                'last_name' => 'required|min:3|max:256',
                'identification' => 'required|min:7|max:10|unique:App\Models\User,identification,'. optional($this->user)->id,
                'email' => 'required|min:3|max:50|email|unique:App\Models\User,email,'. optional($this->user)->id,
                'phone' => 'required|min:3|max:11',
                'city' => 'required|min:3|max:256',
                'address' => 'required',
                'password_confirmation' => 'same:password',
            ];
        }

        //Tramos los datos al editar y lo volcamos en variables
        public function edit(User $user)
        {

        }

        public function updated($propertyName)
        {
            $this->validateOnly($propertyName);
        }

        //Actualizamos formulario de edicion
        public function update()
        {
            //Validamos los campos
            $this->validate();
            //Guardamos los registros
            if ($update = User::where('id', auth()->user()->id)->first()) {
                $update->first_name = $this->first_name;
                $update->last_name = $this->last_name;
                $update->identification = $this->identification;
                $update->email = $this->email;
                $update->phone = $this->phone;
                $update->address = $this->address;
                $update->city = $this->city;

                if (!is_null($this->password)) {
                    $update->password = Hash::make($this->password);
                }

                // $update->syncRoles([$this->user->id_roles]);

                $update->save();
            }
            //Cerramos la ventana modal
            $this->emit('update');
            //Limpiamos validaciones
            $this->resetErrorBag();
            $this->resetValidation();
            //Limpiamos Campos
            $this->reset(['last_name', 'first_name', 'email', 'phone', 'city', 'address', 'identification']);
            //Enviamos el mensaje de confirmacion
            $this->emit('alert', 'Registro Actualizada sastifactoriamente');
            //Redireccionar a la pagina home
            return redirect()->to('/home');
        }

        //Cerrar una ventana modal
        public function close()
        {
            //Limpiamos validaciones
            $this->resetErrorBag();
            $this->resetValidation();
            //Limpiamos Campos
            $this->reset(['last_name', 'first_name', 'email', 'phone', 'city', 'address', 'identification']);
        }

}

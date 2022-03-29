<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;
use App\Models\User;

class Sidebar extends Component
{
    public function render()
    {
        return view('livewire.components.sidebar');
    }

    public function sidebar()
    {
        if (auth()->user()->sidebar  == 1) {

            $sidebar = 0;
            if ($update = User::where('id', auth()->user()->id)->first()) {
                $update->sidebar = $sidebar;
                $update->save();
            }
        } else {
            $sidebar = 1;
            if ($update = User::where('id', auth()->user()->id)->first()) {
                $update->sidebar = $sidebar;
                $update->save();
            }
        }
    }
}

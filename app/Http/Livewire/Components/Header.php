<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;
use App\Models\User;

class Header extends Component
{
    public function render()
    {
        return view('livewire.components.header');
    }

    public function theme()
    {
        if (auth()->user()->theme  == 1) {

            $heme = 0;
            if ($update = User::where('id', auth()->user()->id)->first()) {
                $update->theme = $heme;
                $update->save();
            }
        } else {
            $heme = 1;
            if ($update = User::where('id', auth()->user()->id)->first()) {
                $update->theme = $heme;
                $update->save();
            }
        }
    }
}

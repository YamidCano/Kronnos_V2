<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Darbaoui\Avatar\Facades\Avatar;

class ListUser extends Component
{
    public function render()
    {
        $user = User::all();
        return view('livewire.user.list-user', compact('user'));
    }
}

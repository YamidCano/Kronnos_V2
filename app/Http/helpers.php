<?php

use Illuminate\Support\Str;

function canView(string $permission): bool
{
    $permissions = auth()->user()->getAllPermissions();
    $permissions = $permissions->filter(function ($p) use ($permission){
        return Str::contains($p->name, $permission);
    });
    return boolval($permissions->count());
}

function can(string $permissions)
{
    if(!auth()->user()->can($permissions)){
        abort(403, 'Usted No tiene permisos para ver esta pagina');
    }
}


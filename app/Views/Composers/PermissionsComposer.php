<?php

namespace App\Views\Composers;

use Illuminate\View\View;

class PermissionsComposer {
    public function compose(View $view) {
        $view->with('user_permissions', auth()->check() ? collect(auth()->user()->allPermissions(['name'])->pluck('name')) : null);
   }
}

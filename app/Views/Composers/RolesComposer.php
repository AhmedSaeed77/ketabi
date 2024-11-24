<?php

namespace App\Views\Composers;

use App\Repository\RoleRepositoryInterface;
use Illuminate\View\View;

class RolesComposer {

    private RoleRepositoryInterface $roleRepository;

    public function __construct(
        RoleRepositoryInterface $roleRepository,
    ) {
        $this->roleRepository = $roleRepository;
    }

    public function compose(View $view) {
        $roles = $this->roleRepository->getNames();
        $view->with('sidebar_roles', $roles);
   }
}

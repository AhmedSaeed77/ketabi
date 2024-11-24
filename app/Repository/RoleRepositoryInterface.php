<?php

namespace App\Repository;

interface RoleRepositoryInterface extends RepositoryInterface
{
    public function getNames();

    public function isExisted(string $name);

    public function getByName(string $name);

    public function getInfo();
}

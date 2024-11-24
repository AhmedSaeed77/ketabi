<?php

namespace App\Repository;

interface InfoRepositoryInterface extends RepositoryInterface
{
    public function getText();
    public function getImages();
    public function updateValues($key,$value);
    public function getValue($key);
    public function getKeys($keys=[]);
}

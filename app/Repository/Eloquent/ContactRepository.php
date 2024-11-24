<?php

namespace App\Repository\Eloquent;

use App\Models\ContactUs;
use App\Repository\ContactRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class ContactRepository extends Repository implements ContactRepositoryInterface
{
    protected Model $model;

    public function __construct(ContactUs $model)
    {
        parent::__construct($model);
    }

}

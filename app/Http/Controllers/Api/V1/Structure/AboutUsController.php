<?php

namespace App\Http\Controllers\Api\V1\Structure;

use App\Http\Requests\Dashboard\Structure\AboutUsRequest;
use Illuminate\Http\Request;

class AboutUsController extends StructureController
{
    protected string $contentKey = 'about-us';
}

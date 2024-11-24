<?php

namespace App\Http\Controllers\Dashboard\Structure;

use App\Http\Requests\Dashboard\Structure\AboutUsRequest;
use Illuminate\Http\Request;

class PrivacyTermsController extends StructureController
{
    protected string $contentKey = 'privacy-policy';
    protected array $locales = ['en', 'ar'];

    public function store(AboutUsRequest $request)
    {
        return parent::_store($request);
    }
}

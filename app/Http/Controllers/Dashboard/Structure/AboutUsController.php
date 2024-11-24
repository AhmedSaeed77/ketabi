<?php

namespace App\Http\Controllers\Dashboard\Structure;

use App\Http\Requests\Dashboard\Structure\PrivacyTermsRequest;
use Illuminate\Http\Request;

class AboutUsController extends StructureController
{
    protected string $contentKey = 'about-us';
    protected array $locales = ['en', 'ar'];

    public function store(PrivacyTermsRequest $request)
    {
        return parent::_store($request);
    }
}

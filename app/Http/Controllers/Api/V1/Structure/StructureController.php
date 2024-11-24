<?php

namespace App\Http\Controllers\Api\V1\Structure;

use App\Http\Controllers\Controller;
use App\Http\Services\Api\V1\Structure\StructureService;

abstract class StructureController extends Controller
{
    protected StructureService $structure;
    protected string $contentKey;
    protected array $with = [null, null];
    protected array $append = [null, null];
    protected $resource = null;

    public function __construct(
        StructureService $structureService,
    )
    {
        $this->structure = $structureService;
    }

    public function __invoke()
    {
        return $this->structure->get($this->contentKey, $this->resource, $this->with);
    }

}

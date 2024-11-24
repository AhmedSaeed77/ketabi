<?php

namespace App\Http\Controllers\Api\V1\EducationalStage;

use App\Http\Controllers\Controller;
use App\Http\Services\Api\V1\EducationalStage\EducationalStageService;
use Illuminate\Http\Request;

class EducationalStageController extends Controller
{
    private EducationalStageService $educationalStage;

    public function __construct(
        EducationalStageService $educationalStageService,
    )
    {
        $this->educationalStage = $educationalStageService;
    }

    public function getInfo() {
        return $this->educationalStage->getInfo();
    }

    public function show($id) {
        return $this->educationalStage->show($id);
    }

    public function getSubjects($id) {
        return $this->educationalStage->getSubjects($id);
    }

    public function getPackages($id) {
        return $this->educationalStage->getPackages($id);
    }

    public function getManagers($id) {
        return $this->educationalStage->getManagers($id);
    }
}

<?php

namespace App\Http\Controllers\Api\V1\Subject;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Package\PackageFilterRequest;
use App\Http\Services\Api\V1\Subject\SubjectService;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    private SubjectService $subject;

    public function __construct(
        SubjectService $subjectService,
    )
    {
        $this->subject = $subjectService;
    }

    public function getInfo() {
        return $this->subject->getInfo();
    }

    public function show($id) {
        return $this->subject->show($id);
    }
}

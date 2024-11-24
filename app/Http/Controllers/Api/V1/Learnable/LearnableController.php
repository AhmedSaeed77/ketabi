<?php

namespace App\Http\Controllers\Api\V1\Learnable;

use App\Http\Controllers\Controller;
use App\Http\Services\Api\V1\Learnable\LearnableService;
use Illuminate\Http\Request;

class LearnableController extends Controller
{
    public function __construct(
        private readonly LearnableService $learnable,
    )
    {
        $this->middleware('accessible-learnable')->only(['learnCourse']);
    }

    public function getCourse($id) {
        return $this->learnable->getCourse($id);
    }

    public function learnCourse($id) {
        return $this->learnable->learnCourse($id);
    }
}

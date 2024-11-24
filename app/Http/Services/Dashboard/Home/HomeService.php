<?php

namespace App\Http\Services\Dashboard\Home;

use App\Repository\BankRepositoryInterface;
use App\Repository\ContactRepositoryInterface;
use App\Repository\EducationalStageRepositoryInterface;
use App\Repository\LearnableRepositoryInterface;
use App\Repository\PaymentRepositoryInterface;
use App\Repository\SubjectRepositoryInterface;
use App\Repository\SubscriptionRepositoryInterface;
use App\Repository\UserRepositoryInterface;

class HomeService
{
    public function __construct(private UserRepositoryInterface $userRepository,
    private EducationalStageRepositoryInterface $educationalStageRepository,
    private SubjectRepositoryInterface $subjectRepository,
    private SubscriptionRepositoryInterface $subscriptionRepository,
    private  LearnableRepositoryInterface $learnableRepository,
    private  PaymentRepositoryInterface $paymentRepository,
    private  BankRepositoryInterface $bankRepository,
    private  ContactRepositoryInterface $contactRepository,
    ){

    }
    public function index(){
        $teachers=$this->userRepository->countWhere('type','teacher');
        $students=$this->userRepository->countWhere('type','student');
        $educationalStage=$this->educationalStageRepository->countWhere();
        $subjects=$this->subjectRepository->countWhere();
        $packages=$this->learnableRepository->countWhere('parent_id',null);
        $subscriptions=$this->subscriptionRepository->countWhere();
        $payments=$this->paymentRepository->countWhere();
        $banks=$this->bankRepository->countWhere();
        $contacts=$this->contactRepository->countWhere();
        return view('dashboard.site.home.index',compact('teachers','students','educationalStage',
        'subjects','subscriptions','packages','payments','banks','contacts'));
    }
}

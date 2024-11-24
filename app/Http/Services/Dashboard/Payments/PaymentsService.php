<?php

namespace App\Http\Services\Dashboard\Payments;


use App\Repository\PaymentRepositoryInterface;

class PaymentsService
{

    private $repository;

    public function __construct(PaymentRepositoryInterface $paymentRepository)
    {
        $this->repository = $paymentRepository;
    }

    public function index()
    {
        $payments = $this->repository->paginate(15, relations: ['user']);
        return view('dashboard.site.payments.index', compact('payments'));
    }

    public function show($id)
    {
        $payment = $this->repository->getById($id, relations: ['user', 'subscriptions','subscriptions.learnable','subscriptions.user']);
        return view('dashboard.site.payments.show', compact('payment'));
    }
}

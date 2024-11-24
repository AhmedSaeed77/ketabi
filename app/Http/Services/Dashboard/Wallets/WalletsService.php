<?php

namespace App\Http\Services\Dashboard\Wallets;

use App\Repository\WalletRepositoryInterface;
use App\Repository\WalletTransactionRepositoryInterface;

class WalletsService
{
    private $repository;
    public function __construct(WalletRepositoryInterface $repository)
    {
        $this->repository=$repository;
    }
    public function index(){
        $wallets=$this->repository->paginate(20);
        return view('dashboard.site.wallets.index',compact('wallets'));
    }
    public function transactions($id){
        $wallet=$this->repository->getById($id,relations: ['transactions']);
        return view('dashboard.site.transactions.index',compact('wallet'));
    }
}

<?php

namespace App\Http\Services\Api\V1\Contact;

use App\Http\Traits\Responser;
use App\Repository\ContactRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ContactService
{
        use Responser;
        public function __construct(private ContactRepositoryInterface $repository){

        }
        public function store ($request){

            DB::beginTransaction();
            try {
                $data=$request->validated();
                $this->repository->create($data);
                DB::commit();
                return $this->responseSuccess(message: __('messages.Message sended successfully'));
            } catch (Exception $e) {
                DB::rollBack();
                return $this->responseFail(message: __('messeges.Something went wrong'));
            }
        }
}

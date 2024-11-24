<?php

namespace App;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

use App\Http\Traits\Responser;


if (!function_exists('responseSuccess')){
    function responseSuccess($status = 200, $message = 'Success', $data = []): JsonResponse{
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $status);
    }
}

if (!function_exists('responseFail')){
    function responseFail($status = 422, $message = 'Failed', $data = []): JsonResponse{
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $status);
    }
}

if (!function_exists('catchError')){
    function catchError($e){
        DB::rollBack();
        return $e->getMessage();
        return responseFail(message: __('messages.Something Went Wrong'));
    }
}



if (! function_exists('store_model')) {
    function store_model($repository , $data , $returnModel = false){
        DB::beginTransaction();
        try {
            $model = $repository->create($data);
            DB::commit();
            return $returnModel ? $model : responseSuccess(message: __('messages.Added Successfully'));
        }catch (\Exception $e){
            return catchError($e);
        }

    }
}

if (! function_exists('update_model')) {
    function update_model($repository , $modelId , $data , $returnModel = false){
        DB::beginTransaction();
        try {
             $repository->update($modelId , $data);
            DB::commit();
            return $returnModel ? $repository->getById($modelId) : responseSuccess(message: __('messages.Updated Successfully'));

        }catch (\Exception $e){
            return catchError($e);

        }

    }
}

if (! function_exists('delete_model')) {
    function delete_model($repository , $modelId , $filesFields = []){
        DB::beginTransaction();
        try {
            $repository->delete($modelId , $filesFields);
            DB::commit();
            return responseSuccess(message: __('messages.Deleted Successfully'));
        }catch (\Exception $e){
            return catchError($e);
        }
    }
}




<?php

namespace App\Repository\Eloquent;

use App\Models\Info;
use App\Repository\InfoRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class InfoRepository extends Repository implements InfoRepositoryInterface
{
    protected Model $model;

    public function __construct(Info $model)
    {
        parent::__construct($model);
    }
    public function getText(){
        return $this->model::query()->where('type','text')->get(['key','value','name_ar','name_en']);
    }
    public function getImages(){
        return $this->model::query()->where('type','image')->get(['key','value','name_ar','name_en']);
    }
    public function updateValues($key,$value) {
        return $this->model::query()->where('key',$key)->update(['value'=>$value]);
    }
    public function getValue($key){
        return $this->model::query()->where('key',$key)->first()->value;
    }
    public function getKeys($keys=[]){
        return $this->model::query()->whereIn('key',$keys)->get('key','value');
    }

}

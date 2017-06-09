<?php

namespace Corp\Repositories;

use Config;

abstract class Repository {

    protected $model = FALSE;

    public function get($select = '*', $take = FALSE, $pagination = FALSE){

        $builder = $this->model->select('*');

        if($take){
            $builder->take($take);
        }

        if($pagination){
            return $this->check($builder->paginate(Config::get('settings.paginate')));
        }

        return $this->check($builder->get());

    }

    protected function check($result){

        if($result->isEmpty()){
            return FALSE;
        }
        $result->transform(function($item, $key){

            if(is_string($item->image) && is_object(json_decode($item->image)) && (json_last_error() == JSON_ERROR_NONE)){

                $item->image = json_decode($item->image);

            }
            return $item;

        });

        return $result;

    }

}
?>
<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected function articles(){

        return $this->hasMany('Corp\Articles');

    }
}

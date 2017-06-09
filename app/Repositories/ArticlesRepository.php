<?php

namespace Corp\Repositories;

use Corp\Article;

class ArticlesRepository extends Repository {

    public function __construct(Article $articles){

        $this->model = $articles;

    }

    public function user(){

        return $this->belongsTo('Corp\User');

    }
}
?>
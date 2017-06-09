<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;

use Corp\Repositories\ArticlesRepository;
use Corp\Repositories\PortfoliosRepository;

use Corp\Http\Requests;

class ArticlesController extends SiteController
{
    public function __construct(PortfoliosRepository $portfolio_repo, ArticlesRepository $article_repo){

        parent::__construct(new \Corp\Repositories\MenusRepository(new \Corp\Menu));

        $this->portfolio_repo = $portfolio_repo;
        $this->article_repo = $article_repo;

        $this->bar = 'right';
        $this->template = env('THEME').'.articles';

    }

    public function index() {

        $articles = $this->getArticles();

        $content = view(env('THEME').'.articles_content')->with('articles', $articles)->render();
        $this->vars = array_add($this->vars, 'content', $content);

        return $this->renderOutput();
    }

    public function getArticles($alias = FALSE){

        $articles = $this->article_repo->get(['id', 'title', 'alias', 'created_at', 'image', 'descript', 'user_id', 'category_id'], FALSE, TRUE);
        if($articles){

           // $articles->load('user', 'category', 'comments');

        }

        return $articles;

    }
}

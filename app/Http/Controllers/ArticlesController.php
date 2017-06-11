<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;

use Corp\Repositories\ArticlesRepository;
use Corp\Repositories\PortfoliosRepository;
use Corp\Repositories\CommentsRepository;

use Corp\Http\Requests;

class ArticlesController extends SiteController
{
    public function __construct(PortfoliosRepository $portfolio_repo, ArticlesRepository $article_repo, CommentsRepository $comment_repo){

        parent::__construct(new \Corp\Repositories\MenusRepository(new \Corp\Menu));

        $this->portfolio_repo = $portfolio_repo;
        $this->article_repo = $article_repo;
        $this->comment_repo = $comment_repo;

        $this->bar = 'right';
        $this->template = env('THEME').'.articles';

    }

    public function index() {

        $articles = $this->getArticles();

        $content = view(env('THEME').'.articles_content')->with('articles', $articles)->render();
        $this->vars = array_add($this->vars, 'content', $content);

        $comments = $this->getComments(config('settings.recent_comments'));
        $portfolios = $this->getPortfolios(config('settings.recent_portfolios'));
        //dd($portfolios);

        $this->contentRightBar = view(env('THEME').'.articlesBar')->with(['comments' => $comments, 'portfolios' => $portfolios]);

        return $this->renderOutput();
    }

    public function getComments($take){

        $comments =$this->comment_repo->get(['text', 'name', 'email', 'site', 'article_id', 'user_id'], $take);
        if($comments){

            $comments->load('article');

        }
        return $comments;

    }

    public function getPortfolios($take){

        $portfolios = $this->portfolio_repo->get(['title', 'text', 'alias', 'customer', 'image', 'filter_alias'], $take);
        return $portfolios;

    }

    public function getArticles($alias = FALSE){

        $articles = $this->article_repo->get(['id', 'title', 'alias', 'created_at', 'image', 'descript', 'user_id', 'category_id'], FALSE, TRUE);
        if($articles){

            $articles->load('user', 'category', 'comment');

        }

        return $articles;

    }

}

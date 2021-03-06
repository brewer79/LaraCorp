<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;

use Corp\Repositories\ArticlesRepository;
use Corp\Repositories\PortfoliosRepository;
use Corp\Repositories\CommentsRepository;

use Corp\Http\Requests;
use Corp\Category;

class ArticlesController extends SiteController
{
    public function __construct(PortfoliosRepository $portfolio_repo, ArticlesRepository $article_repo, CommentsRepository $comment_repo){

        parent::__construct(new \Corp\Repositories\MenusRepository(new \Corp\Menu));

        $this->portfolio_repo = $portfolio_repo;
        $this->article_repo = $article_repo;
        $this->comment_repo = $comment_repo;

        $this->bar = 'right';
        $this->template = config('settings.theme').'.articles';

    }

    public function index($category_alias = FALSE) {

        $this->title = 'Блог';  // доделать!
        $this->keywords = 'Keywords';
        $this->meta_desc = 'meta_desc';

        $articles = $this->getArticles($category_alias);

        $content = view(config('settings.theme').'.articles_content')->with('articles', $articles)->render();
        $this->vars = array_add($this->vars, 'content', $content);

        $comments = $this->getComments(config('settings.recent_comments'));
        $portfolios = $this->getPortfolios(config('settings.recent_portfolios'));
        //dd($portfolios);

        $this->contentRightBar = view(config('settings.theme').'.articlesBar')->with(['comments' => $comments, 'portfolios' => $portfolios]);

        return $this->renderOutput();
    }

    public function getComments($take){

        $comments =$this->comment_repo->get(['text', 'name', 'email', 'site', 'article_id', 'user_id'], $take);
        if($comments){

            $comments->load('article', 'user');

        }
        return $comments;

    }

    public function getPortfolios($take){

        $portfolios = $this->portfolio_repo->get(['title', 'text', 'alias', 'customer', 'image', 'filter_alias'], $take);
        return $portfolios;

    }

    public function getArticles($alias = FALSE){

        $where = FALSE;
        if($alias){

            // WHERE  'alias' == $alias
            $id = Category::select('id')->where('alias', $alias)->first()->id;
            // WHERE  'category_id' == $id
            $where = ['category_id', $id];

        }
        $articles = $this->article_repo->get(['id', 'title', 'alias', 'created_at', 'image', 'descript', 'user_id', 'category_id', 'keywords', 'meta_desc'], FALSE, TRUE, $where);
        if($articles){

            $articles->load('user', 'category', 'comment');

        }

        return $articles;

    }

    public function show($alias = FALSE){

        $article = $this->article_repo->one($alias, ['comments' => TRUE]);

        if($article){

            $article->image = json_decode($article->image);

        }
        //dd($article->comment->groupBy('parent_id'));

        if(isset($article->id)){

            $this->title = $article->title;
            $this->keywords = $article->keywords;
            $this->meta_desc = $article->meta_desc;

        }
        else{

            return redirect('/articles');

        }

        $content = view(config('settings.theme').'.article_content')->with('article', $article)->render();
        $this->vars = array_add($this->vars, 'content', $content);

        $comments = $this->getComments(config('settings.recent_comments'));
        $portfolios = $this->getPortfolios(config('settings.recent_portfolios'));

        $this->contentRightBar = view(config('settings.theme').'.articlesBar')->with(['comments' => $comments, 'portfolios' => $portfolios]);


        return $this->renderOutput();

    }

}

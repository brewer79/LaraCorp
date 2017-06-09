<?php

namespace Corp\Http\Controllers;

use Corp\Repositories\ArticlesRepository;
use Corp\Repositories\PortfoliosRepository;
use Corp\Repositories\SlidersRepository;
use Illuminate\Http\Request;

use Corp\Http\Requests;
use Illuminate\Support\Facades\Config;

class IndexController extends SiteController{

    public function __construct(SlidersRepository $slider_repo, PortfoliosRepository $portfolio_repo, ArticlesRepository $article_repo){

        parent::__construct(new \Corp\Repositories\MenusRepository(new \Corp\Menu));

        $this->slider_repo = $slider_repo;
        $this->portfolio_repo = $portfolio_repo;
        $this->article_repo = $article_repo;

        $this->bar = 'right';
        $this->template = env('THEME').'.index';

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $portfolios = $this->getPortfolio();
        //dd($portfolios);
        $content = view(env('THEME').'.content')->with('portfolios', $portfolios)->render();
        $this->vars = array_add($this->vars, 'content', $content);

        $sliderItems = $this->getSliders();

        $sliders = view(env('THEME').'.slider')->with('sliders', $sliderItems)->render();
        $this->vars = array_add($this->vars, 'sliders', $sliders);

        $this->keywords = 'Home Page';
        $this->meta_desc = 'Home Page';
        $this->title = 'Home Page';

        $articles = $this->getArticles();
        //dd($articles);
        $this->contentRightBar =view(env('THEME').'.indexBar')->with('articles', $articles)->render();

        return $this->renderOutput();
    }

    protected function getArticles(){

        $articles = $this->article_repo->get(['title', 'created_at', 'image', 'alias'], Config::get('settings.homepage_articles_count'));
        return $articles;

    }

    protected function getPortfolio(){

        $portfolio = $this->portfolio_repo->get('*', Config::get('settings.homepage_portfolio_count'));
        return $portfolio;

    }

    public function getSliders(){

        $sliders = $this->slider_repo->get();

        if($sliders->isEmpty()){
            return FALSE;
        }
        $sliders->transform(function($item, $key){

            $item->image = Config::get('settings.slider_path').'/'.$item->image;
            return $item;

        });
        //dd($sliders);

        return $sliders;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

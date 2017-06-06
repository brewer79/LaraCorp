<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;

use Corp\Http\Requests;

class SiteController extends Controller
{
    protected $portfolio_repo;
    protected $slider_repo;
    protected $article_repo;
    protected $menu_repo;

    protected $template;

    protected $vars = array();

    protected $contentRightBar = FALSE;
    protected $contentLeftBar = FALSE;

    protected $bar = FALSE;

    public function __construct(){

    }

    protected function renderOutput(){

        return view($this->template)->with($this->vars);
    }
}

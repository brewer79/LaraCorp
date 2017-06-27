<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;
use Corp\Http\Requests;
use Corp\Repositories\MenusRepository;
use Menu;

class SiteController extends Controller
{
    protected $portfolio_repo;
    protected $slider_repo;
    protected $article_repo;
    protected $menu_repo;
    protected $comment_repo;

    protected $keywords;
    protected $meta_desc;
    protected $title;

    protected $template;

    protected $vars = array();

    protected $contentRightBar = FALSE;
    protected $contentLeftBar = FALSE;

    protected $bar = 'no';

    public function __construct(MenusRepository $menu_repo)
    {
        $this->menu_repo = $menu_repo;
    }

    protected function renderOutput()
    {
        $menu = $this->getMenu();

        $navigation = view(env('THEME').'.navigation')->with('menu', $menu)->render();
        $this->vars = array_add($this->vars, 'navigation', $navigation);

        if($this->contentRightBar)
        {
            $rightBar = view(env('THEME').'.rightBar')->with('content_rightBar', $this->contentRightBar)->render();
            $this->vars = array_add($this->vars, 'rightBar', $rightBar);
        }

        if($this->contentLeftBar)
        {
            $leftBar = view(env('THEME').'.leftBar')->with('content_leftBar', $this->contentLeftBar)->render();
            $this->vars = array_add($this->vars, 'leftBar', $leftBar);
        }

        $this->vars = array_add($this->vars, 'bar', $this->bar);

        $this->vars = array_add($this->vars, 'keywords', $this->keywords);
        $this->vars = array_add($this->vars, 'meta_desc', $this->meta_desc);
        $this->vars = array_add($this->vars, 'title', $this->title);

        $footer = view(env('THEME').'.footer')->render();
        $this->vars = array_add($this->vars, 'footer', $footer);

        return view($this->template)->with($this->vars);
    }

    public function getMenu()
    {
        $menu = $this->menu_repo->get();
        //dd($menu);
        $menuBuilder = Menu::make('myNav', function($m) use ($menu)
        {
            foreach($menu as $item)
            {
                if($item->parent == 0)
                {
                    $m->add($item->title, $item->path)->id($item->id);
                }
                else
                {
                    if($m->find($item->parent))
                    {
                        $m->find($item->parent)->add($item->title, $item->path)->id($item->id);
                    }
                }
            }
        });
        //dd($menuBuilder);
        return $menuBuilder;
    }
}

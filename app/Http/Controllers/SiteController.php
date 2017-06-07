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

    protected $template;

    protected $vars = array();

    protected $contentRightBar = FALSE;
    protected $contentLeftBar = FALSE;

    protected $bar = FALSE;

    public function __construct(MenusRepository $menu_repo){

        $this->menu_repo = $menu_repo;

    }

    protected function renderOutput(){

        $menu = $this->getMenu();


        $navigation = view(env('THEME').'.navigation')->with('menu', $menu)->render();
        $this->vars = array_add($this->vars, 'navigation', $navigation);

        return view($this->template)->with($this->vars);
    }

    protected function getMenu(){

        $menu = $this->menu_repo->get();
        //dd($menu);
        $menuBuilder = Menu::make('myNav', function($m) use ($menu) {

            foreach($menu as $item){

                if($item->parent_id == 0){

                    $m->add($item->title, $item->path)->id($item->id);

                }else{

                    if($m->find($item->parent_id)){

                        $m->find($item->parent_id)->add($item->title, $item->path)->id($item->id);

                    }

                }

            }

        });
        //dd($menuBuilder);
        return $menuBuilder;

    }
}

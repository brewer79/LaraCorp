<?php

namespace Corp\Http\Controllers\Admin;

use Corp\Repositories\MenusRepository;
use Corp\Repositories\ArticlesRepository;
use Corp\Repositories\PortfoliosRepository;
use Illuminate\Http\Request;

use Corp\Http\Requests;
use Corp\Http\Controllers\Controller;
use Gate;
use Menu;

class MenusController extends AdminController
{
    protected $menu_repo;

    public function __construct(MenusRepository $menu_repo, ArticlesRepository $article_repo, PortfoliosRepository $portfolio_repo)
    {
        parent::__construct();

        if(Gate::denies('VIEW_ADMIN_MENU'))
        {
            abort(403);
        }

        $this->menu_repo = $menu_repo;
        $this->article_repo = $article_repo;
        $this->portfolio_repo = $portfolio_repo;

        $this->template = env('THEME').'.admin.menus';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->title = 'Меню';
        // not getMenu from AdminController !!!
        $menu = $this->getMenus();
        $this->content = view(env('THEME').'.admin.menus_content')->with('menus', $menu)->render();
        return $this->renderOutput();
    }

    public function getMenus()
    {
        $menu = $this->menu_repo->get();
        if($menu->isEmpty())
        {
            return false;
        }
        return Menu::make('forMenuPart', function($m) use($menu)
        {
            foreach($menu as $item)
            {
                if($item->parent == 0)
                {
                    $m->add($item->title, $item->path)->id($item->id);
                }
                else
                {
                    if ($m->find($item->parent))
                    {
                        $m->find($item->parent)->add($item->title, $item->path)->id($item->id);
                    }
                }
            }
        });
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

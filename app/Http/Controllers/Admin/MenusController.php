<?php

namespace Corp\Http\Controllers\Admin;

use Corp\Category;
use Corp\Filter;
use Corp\Repositories\MenusRepository;
use Corp\Repositories\ArticlesRepository;
use Corp\Repositories\PortfoliosRepository;
use Illuminate\Http\Request;

use Corp\Http\Requests;
use Corp\Http\Requests\MenuRequest;
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

        $this->template = config('settings.theme').'.admin.menus';
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
        //dd($menu);
        $this->content = view(config('settings.theme').'.admin.menus_content')->with('menus', $menu)->render();
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
                    $m->add($item->title,$item->path)->id($item->id);
                }
                else
                {
                    if($m->find($item->parent))
                    {
                        $m->find($item->parent)->add($item->title,$item->path)->id($item->id);
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
        $this->title = 'Новый пункт меню';

        $tmp = $this->getMenus()->roots();
        //dd($tmp);
        $menus = $tmp->reduce(function($returnMenus, $menu)
        {
            $returnMenus[$menu->id] = $menu->title;
            return $returnMenus;
        }, ['0' => 'Родительский пункт меню']);
        //dd($menus);

        $categories = Category::select(['title', 'alias', 'parent_id', 'id'])->get();
        //dd($categories);
        $list = array();
        $list = array_add($list, '0', 'Не используется');
        $list = array_add($list, 'parent', 'Раздел Блог');

        foreach($categories as $category)
        {
            if($category->parent_id == 0)
            {
                $list[$category->title] = array();
            }
            else
            {
                $list[$categories->where('id', $category->parent_id)->first()->title][$category->alias] = $category->title;
            }
        }

        $articles = $this->article_repo->get(['id', 'title', 'alias']);
        //dd($articles);
        $articles = $articles->reduce(function($returnArticles, $article)
        {
            $returnArticles[$article->alias] = $article->title;
            return $returnArticles;
        }, []);
        //dd($articles);

        $filters = Filter::select('id','title','alias')->get()->reduce(function ($returnFilters, $filter)
        {
            $returnFilters[$filter->alias] = $filter->title;
            return $returnFilters;
        }, ['parent' => 'Раздел портфолио']);

        $portfolios = $this->portfolio_repo->get(['id','alias','title'])->reduce(function ($returnPortfolios, $portfolio)
        {
            $returnPortfolios[$portfolio->alias] = $portfolio->title;
            return $returnPortfolios;
        }, []);

        $this->content = view(config('settings.theme').'.admin.menus_create_content')->with(['menus'=>$menus,'categories'=>$list,'articles'=>$articles,'filters' => $filters,'portfolios' => $portfolios])->render();

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
    {
        $result = $this->menu_repo->addMenu($request);
        if(is_array($result) && !empty($result['error']))
        {
            return back()->with($result);
        }
        return redirect('/admin')->with($result);
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
    public function edit(\Corp\Menu $menu)
    {
        //dd($menu);
        $this->title = 'Редактирование ссылки - '.$menu->title;

        $type = false;
        $option = false;

        $route = app('router')->getRoutes()->match(app('request')->create($menu->path));

        $aliasRoute = $route->getName();
        $parameters = $route->parameters();

        //dump($aliasRoute);
        //dump($parameters);

        if($aliasRoute == 'articles.index' || $aliasRoute == 'articlesCategory')
        {
            $type = 'blogLink';
            $option = isset($parameters['category_alias']) ? $parameters['category_alias'] : 'parent';
        }
        else if($aliasRoute == 'articles.show')
        {
            $type = 'blogLink';
            $option = isset($parameters['alias']) ? $parameters['alias'] : '';
        }
        else if($aliasRoute == 'portfolios.index')
        {
            $type = 'portfolioLink';
            $option = 'parent';
        }
        else if($aliasRoute == 'portfolios.show')
        {
            $type = 'portfolioLink';
            $option = isset($parameters['alias']) ? $parameters['alias'] : '';
        }
        else
        {
            $type = 'customLink';
        }

        $temp = $this->getMenus()->roots();
        //dd($tmp);
        $menus = $temp->reduce(function($returnMenus, $menu)
        {
            $returnMenus[$menu->id] = $menu->title;
            return $returnMenus;
        }, ['0' => 'Родительский пункт меню']);
        //dd($menus);

        $categories = Category::select(['title', 'alias', 'parent_id', 'id'])->get();
        //dd($categories);
        $list = array();
        $list = array_add($list, '0', 'Не используется');
        $list = array_add($list, 'parent', 'Раздел Блог');

        foreach($categories as $category)
        {
            if($category->parent_id == 0)
            {
                $list[$category->title] = array();
            }
            else
            {
                $list[$categories->where('id', $category->parent_id)->first()->title][$category->alias] = $category->title;
            }
        }

        $articles = $this->article_repo->get(['id', 'title', 'alias']);
        //dd($articles);
        $articles = $articles->reduce(function($returnArticles, $article)
        {
            $returnArticles[$article->alias] = $article->title;
            return $returnArticles;
        }, []);
        //dd($articles);

        $filters = Filter::select('id','title','alias')->get()->reduce(function ($returnFilters, $filter)
        {
            $returnFilters[$filter->alias] = $filter->title;
            return $returnFilters;
        }, ['parent' => 'Раздел портфолио']);

        $portfolios = $this->portfolio_repo->get(['id','alias','title'])->reduce(function ($returnPortfolios, $portfolio)
        {
            $returnPortfolios[$portfolio->alias] = $portfolio->title;
            return $returnPortfolios;
        }, []);

        $this->content = view(config('settings.theme').'.admin.menus_edit_content')->with(['menu' => $menu, 'type' => $type, 'option' => $option, 'menus'=>$menus,'categories'=>$list,'articles'=>$articles,'filters' => $filters,'portfolios' => $portfolios])->render();

        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, \Corp\Menu $menu)
    {
        $result = $this->menu_repo->updateMenu($request,$menu);

        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect('/admin')->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(\Corp\Menu $menu)
    {
        $result = $this->menu_repo->deleteMenu($menu);

        if(is_array($result) && !empty($result['error']))
        {
            return back()->with($result);
        }

        return redirect('/admin')->with($result);
    }
}

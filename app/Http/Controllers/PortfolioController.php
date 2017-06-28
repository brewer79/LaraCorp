<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;
use Corp\Repositories\PortfoliosRepository;

use Corp\Http\Requests;

class PortfolioController extends SiteController
{
    public function __construct(PortfoliosRepository $portfolio_repo){

        parent::__construct(new \Corp\Repositories\MenusRepository(new \Corp\Menu));

        $this->portfolio_repo = $portfolio_repo;

        $this->template = config('settings.theme').'.portfolios';

    }

    public function index() {

        $this->title = 'Портфолио';
        $this->keywords = 'Keywords'; // доделать!
        $this->meta_desc = 'meta_desc';

        $portfolios = $this->getPortfolios();

        $content = view(config('settings.theme').'.portfolios_content')->with('portfolios', $portfolios)->render();
        $this->vars = array_add($this->vars, 'content', $content);


        return $this->renderOutput();
    }

    public function getPortfolios($take =FALSE, $pagination = TRUE) {

        $portfolios = $this->portfolio_repo->get('*', $take, $pagination);
        if($portfolios) {

            $portfolios->load('filter');

        }
        return $portfolios;

    }

    public function show($alias){

        $portfolio = $this->portfolio_repo->one($alias);
        $portfolios = $this->getPortfolios(config('settings.other_portfolios'), FALSE);

        $this->title = $portfolio->title;
        $this->keywords = $portfolio->keywords;
        $this->meta_desc = $portfolio->meta_desc;

        $content = view(config('settings.theme').'.portfolio_content')->with(['portfolio' => $portfolio,'portfolios' => $portfolios])->render();
        $this->vars = array_add($this->vars, 'content', $content);

        return $this->renderOutput();

    }
}

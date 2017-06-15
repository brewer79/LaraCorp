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

        $this->template = env('THEME').'.portfolios';

    }

    public function index() {

        $this->title = 'Портфолио';
        $this->keywords = 'Keywords'; // доделать!
        $this->meta_desc = 'meta_desc';

        $portfolios = $this->getPortfolios();

        $content = view(env('THEME').'.portfolios_content')->with('portfolios', $portfolios)->render();
        $this->vars = array_add($this->vars, 'content', $content);


        return $this->renderOutput();
    }

    public function getPortfolios() {

        $portfolios = $this->portfolio_repo->get('*', FALSE, TRUE);
        if($portfolios) {

            $portfolios->load('filter');

        }
        return $portfolios;

    }
}

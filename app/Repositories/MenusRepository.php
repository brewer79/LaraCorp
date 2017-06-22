<?php

namespace Corp\Repositories;

use Corp\Menu;

class MenusRepository extends Repository {

    public function __construct(Menu $menu)
    {
        $this->model = $menu;
    }

    public function addMenu($request)
    {
        if(Gate::denies('save', $this->model))
        {
            abort(403);
        }

        $data = $request->only('_token', 'image', '_method');
    }
}
?>
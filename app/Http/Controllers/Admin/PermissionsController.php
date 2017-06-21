<?php

namespace Corp\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Corp\Http\Requests;
use Corp\Http\Controllers\Controller;
use Gate;
use Corp\Repositories\PermissionsRepository;
use Corp\Repositories\RolesRepository;


class PermissionsController extends AdminController
{
    protected $permission_repo;
    protected $role_repo;

    public function __construct(PermissionsRepository $permission_repo, RolesRepository $role_repo){

        parent::__construct();

        if(Gate::denies('EDIT_USERS'))
        {
            abort(403);
        }
        $this->permission_repo = $permission_repo;
        $this->role_repo = $role_repo;
        $this->template = env('THEME').'.admin.permissions';

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->title = 'Менеджер прав пользователей';
        $roles = $this->getRoles();
        $permissions = $this->getPermissions();

        $this->content = view(env('THEME').'.admin.permissions_content')->with(['roles' => $roles, 'privilege' => $permissions])->render();
        return $this->renderOutput();
    }

    public function getRoles()
    {
        $roles = $this->role_repo->get();
        return $roles;
    }

    public function getPermissions()
    {
        $permissions = $this->permission_repo->get();
        return $permissions;
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
        $result = $this->permission_repo->changePermissions($request);

        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return back()->with($result);
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

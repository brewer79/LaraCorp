<?php

namespace Corp\Repositories;

use Corp\Permission;
use Corp\Role;
use Gate;


class PermissionsRepository extends Repository {

    protected $role_repo;

    public function __construct(Permission $permission, RolesRepository $role_repo)
    {
        $this->model = $permission;
        $this->role_repo = $role_repo;
    }

    public function changePermissions($request)
    {
        if(Gate::denies('change', $this->model))
        {
            abort(403);
        }

        $data = $request->except('_token');
        $roles = $this->role_repo->get();
        foreach($roles as $value)
        {
            if(isset($data[$value->id]))
            {
                $value->savePermissions($data[$value->id]);
            }
            else
            {
                $value->savePermissions([]);
            }
        }
        return ['status' => 'Права обновлены'];
    }
}
?>
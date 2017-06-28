<?php

namespace Corp\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Corp\Http\Requests;
use Corp\Http\Requests\UserRequest;
use Corp\Http\Controllers\Controller;

use Corp\Repositories\UsersRepository;
use Corp\Repositories\RolesRepository;

use Corp\User;
use Corp\Role;
use Gate;

class UsersController extends AdminController
{
    protected $user_repo;
    protected $role_repo;

    public function __construct(RolesRepository $role_repo, UsersRepository $user_repo)
    {
        parent::__construct();

        if (Gate::denies('EDIT_USERS'))
        {
            abort(403);
        }

        $this->user_repo = $user_repo;
        $this->role_repo = $role_repo;

        $this->template = config('settings.theme').'.admin.users';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->title = 'Пользователи';

        $users = $this->user_repo->get();

        $this->content = view(config('settings.theme').'.admin.users_content')->with(['users'=>$users])->render();

        return $this->renderOutput();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->title =  'Новый пользователь';

        $roles = $this->getRoles()->reduce(function ($returnRoles, $role)
        {
            $returnRoles[$role->id] = $role->name;
            return $returnRoles;
        }, []);;

        $this->content = view(config('settings.theme').'.admin.users_create_content')->with('roles',$roles)->render();

        return $this->renderOutput();
    }

    public function getRoles()
    {
        return Role::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $result = $this->user_repo->addUser($request);

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
    public function edit(User $user)
    {
        $this->title =  'Редактирование пользователя - '. $user->name;

        $roles = $this->getRoles()->reduce(function ($returnRoles, $role)
        {
            $returnRoles[$role->id] = $role->name;
            return $returnRoles;
        }, []);

        $this->content = view(config('settings.theme').'.admin.users_create_content')->with(['roles'=>$roles,'user'=>$user])->render();

        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $result = $this->user_repo->updateUser($request,$user);

        if(is_array($result) && !empty($result['error']))
        {
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
    public function destroy(User $user)
    {
        $result = $this->user_repo->deleteUser($user);

        if(is_array($result) && !empty($result['error']))
        {
            return back()->with($result);
        }

        return redirect('/admin')->with($result);
    }
}

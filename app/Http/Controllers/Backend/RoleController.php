<?php

namespace App\Http\Controllers\Backend;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Auth;
class RoleController extends BackendBaseController
{
    protected $base_route = 'backend.roles';
    protected $view_path = 'backend.roles';
    protected $home_route = 'backend.dashboard';
    protected $model;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //if (Auth::user()->can('read-roles')) {
            $data = [];
            $data['rows'] = Role::paginate(15);
            return view(parent::loadDefaultVars($this->view_path . '.index'), compact('data'));
        //} else {
         //   return redirect()->route($this->home_route)->with('alert-danger', trans('backend/general.message.unauthorized'));

        //}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->can('create-roles')) {
            $data = [];
            $data['rows'] = Permission::all();
            return view(parent::loadDefaultVars($this->view_path . '.create'), compact('data'));
        } else {
            return redirect()->route($this->home_route)->with('alert-danger', trans('backend/general.message.unauthorized'));

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->can('create-roles')) {
            $this->validate($request, [
                'name' => 'required|max:255',
                'display_name' => 'required|max:255',
                'user_level' => 'required|unique:roles'

            ]);
            $data = [];
            $data['row'] = Role::create([
                'name' => $request->get('name'),
                'display_name' => $request->get('display_name'),
                'description' => $request->get('description'),
                'user_level' => $request->get('user_level'),
            ]);
            $data['row']->syncPermissions($request->permissions);

            if ($data['row']) {
                return redirect()->route($this->base_route)->with('alert-success', trans('backend/general.message.save'));
            }
            return redirect()->route($this->base_route)->with('alert-danger', trans('backend/general.message.fail'));;
        } else {
            return redirect()->route($this->home_route)->with('alert-danger', trans('backend/general.message.unauthorized'));

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [];
        $data['row'] = Role::findOrFail($id);
        $data['permissions'] = Permission::all();
        return view(parent::loadDefaultVars($this->view_path . '.edit'), compact('data'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'display_name' => 'required|max:255',
            'user_level' => 'required|unique:roles,user_level,' . $id,

        ]);

        $data = [];
        $data['row'] = Role::findOrFail($id);
        $data['row']->update([
            'name' => $request->get('name'),
            'display_name' => $request->get('display_name'),
            'description' => $request->get('description'),
            'user_level' => $request->get('user_level'),
        ]);
        $data['row']->syncPermissions($request->permissions);
        if ($data['row']) {
            return redirect()->route($this->base_route)->with('alert-success', trans('backend/general.message.update'));
        }
        return redirect()->route($this->base_route)->with('alert-danger', trans('backend/general.message.fail'));;

    }
}

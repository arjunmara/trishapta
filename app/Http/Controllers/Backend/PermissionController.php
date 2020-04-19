<?php

namespace App\Http\Controllers\Backend;

use App\Permission;
use Illuminate\Http\Request;

class PermissionController extends BackendBaseController
{
    protected $base_route = 'backend.permissions';
    protected $view_path = 'backend.permissions';
    protected $model;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['rows'] = Permission::paginate(15);
        return view(parent::loadDefaultVars($this->view_path . '.index'), compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(parent::loadDefaultVars($this->view_path . '.create'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'display_name' => 'required|max:255',

        ]);
        $data = [];
        $data['row'] = Permission::create([
            'name' => $request->get('name'),
            'display_name' => $request->get('display_name'),
            'description' => $request->get('description'),
        ]);

        if ($data['row']) {
            return redirect()->route($this->base_route)->with('alert-success', trans('backend/general.message.save'));
        }
        return redirect()->route($this->base_route)->with('alert-danger', trans('backend/general.message.fail'));;

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
        $data['row'] = Permission::findOrFail($id);
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

        ]);

        $data = [];
        $data['row'] = Permission::findOrFail($id);
        $data['row']->update([
            'name' => $request->get('name'),
            'display_name' => $request->get('display_name'),
            'description' => $request->get('description'),
        ]);

        if ($data['row']) {
            return redirect()->route($this->base_route)->with('alert-success', trans('backend/general.message.update'));
        }
        return redirect()->route($this->base_route)->with('alert-danger', trans('backend/general.message.fail'));;

    }

}

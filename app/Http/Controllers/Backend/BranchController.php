<?php

namespace App\Http\Controllers\Backend;

use App\Branch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BranchController extends BackendBaseController
{
    protected $base_route = 'backend.branches';
    protected $view_path = 'backend.branches';
    protected $model;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['rows'] = Branch::paginate(15);
        return view(parent::loadDefaultVars($this->view_path . '.index'), compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        $data['rows'] = Branch::all();
        return view(parent::loadDefaultVars($this->view_path . '.create'),compact('data'));
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
            'branch_name' => 'required|max:255',
            'location' => 'required|max:255',

        ]);
        $data = [];
        $data['row'] = Branch::create([
            'branch_name' => $request->get('branch_name'),
            'location' => $request->get('location'),
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
        $data['row'] = Branch::findOrFail($id);
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
            'branch_name' => 'required|max:255',
            'location' => 'required|max:255',

        ]);

        $data = [];
        $data['row'] = Branch::findOrFail($id);
        $data['row']->update([
            'branch_name' => $request->get('branch_name'),
            'location' => $request->get('location'),
            'description' => $request->get('description'),
        ]);

        if ($data['row']) {
            return redirect()->route($this->base_route)->with('alert-success', trans('backend/general.message.update'));
        }
        return redirect()->route($this->base_route)->with('alert-danger', trans('backend/general.message.fail'));;

    }
}

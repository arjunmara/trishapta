<?php

namespace App\Http\Controllers\Backend;

use App\ResponseKeyword;
use Illuminate\Http\Request;

class ResponseKeywordController extends BackendBaseController
{
    protected $base_route = 'backend.response-keyword';
    protected $view_path = 'backend.response-keyword';
    protected $model;

    /**
     * ResponseKeywordController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['rows'] = ResponseKeyword::paginate(15);
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
            'title' => 'required|max:255',
        ]);
        $data = [];
        $data['row'] = ResponseKeyword::create([
            'title' => $request->get('title'),
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
        $data['row'] = ResponseKeyword::findOrFail($id);
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
            'title' => 'required|max:255',
        ]);

        $data = [];
        $data['row'] = ResponseKeyword::findOrFail($id);
        $data['row']->update([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
        ]);

        if ($data['row']) {
            return redirect()->route($this->base_route)->with('alert-success', trans('backend/general.message.update'));
        }
        return redirect()->route($this->base_route)->with('alert-danger', trans('backend/general.message.fail'));;

    }
}

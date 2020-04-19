<?php

namespace App\Http\Controllers\Backend;

use App\PrimaryCategory;
use App\SecondaryCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PrimaryCategoryController extends BackendBaseController
{
    protected $base_route = 'backend.primary-category';
    protected $view_path = 'backend.primary-category';
    protected $model;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['rows'] = PrimaryCategory::select('id', 'title', 'description')->paginate(10);
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
        //dd($request->all());

        $data = [];
        $data['row'] = PrimaryCategory::create([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
        ]);

        return redirect()->route($this->base_route)->with('alert-success', trans('backend/general.message.save'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function sortable()
    {
        $datas = PrimaryCategory::select('title')->paginate(10);
        return view(parent::loadDefaultVars($this->view_path . '.sortable'), compact('datas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$this->idExist($id)) {
            return redirect()->route($this->view_path);
        }

        $data['row'] = $this->model;
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
        if (!$this->idExist($id)) {
            return redirect()->route($this->base_route)->withErrors(['message' => 'Invalid Request']);
        }

        $data = $this->model;
        $data->update([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
        ]);

        return redirect()->route($this->base_route)->with('alert-success', trans('backend/general.message.update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if (!$this->idExist($id)) {
            return redirect()->route($this->base_route)->with(['alert-danger' => 'Invalid Id']);
        }
        $hasSecondaryCategory = SecondaryCategory::where('primary_category_id',$id)->first();

        if (!empty($hasSecondaryCategory)) {
            return redirect()->route($this->base_route)->with('alert-danger', 'This category has secondary category(ies). Unable to delete!');
        }

        $result = PrimaryCategory::destroy($id);
        if($result)
        {
            return redirect()->route($this->base_route)->with('alert-success', trans('backend/general.message.delete'));
        }
        return redirect()->route($this->base_route)->with('alert-danger', trans('backend/general.message.fail'));;


    }

    public function status()
    {
        $id = request('url');

        $this->idExist($id);

        if ($this->model->status == 1)
            $this->model->status = 0;
        else
            $this->model->status = 1;

        $this->model->save();

        return response()->json(json_encode([
            'error' => false,
            'message' => 'success',
            'status' => $this->model->status
        ]));
    }


    /**
     * helper idExist class
     */
    public function idExist($id)
    {
        $this->model = PrimaryCategory::find($id);
        return $this->model;
    }
}

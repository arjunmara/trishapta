<?php

namespace App\Http\Controllers\Backend;

use App\PrimaryCategory;
use App\Product;
use App\SecondaryCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SecondaryCategoryController extends BackendBaseController
{
    protected $base_route = 'backend.secondary-category';
    protected $view_path = 'backend.secondary-category';
    protected $model;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['rows'] = SecondaryCategory::paginate(10);
        return view(parent::loadDefaultVars($this->view_path . '.index'), compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['rows'] = PrimaryCategory::all();
        return view(parent::loadDefaultVars($this->view_path . '.create'), compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [];
        $data['row'] = SecondaryCategory::create([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'primary_category_id' => $request->get('primary_category_id')
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
        $datas = SecondaryCategory::select('title')->paginate(10);
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
        $data['rows'] = PrimaryCategory::all();
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
            'primary_category_id' => $request->get('primary_category_id')
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
        $hasProduct = Product::where('secondary_category_id', $id)->first();

        if (!empty($hasProduct)) {
            return redirect()->route($this->base_route)->with('alert-danger', 'This category has Products related to it. Unable to delete!');
        }
        $result = SecondaryCategory::destroy($id);
        if ($result) {
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
        $this->model = SecondaryCategory::find($id);
        return $this->model;
    }

}

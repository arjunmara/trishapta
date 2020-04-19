<?php

namespace App\Http\Controllers\Backend;

use App\HomeSlider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeSliderController extends BackendBaseController
{
    protected $image_url;
    protected $model;
    protected $base_route = 'backend.homeslider';
    protected $view_path = 'backend.homeslider';

    public function __construct()
    {
        parent::__construct();

        $this->image_url = $this->image_url . 'homeslider/';

    }

    public function index()
    {
        $data = [];
        $data['rows'] = HomeSlider::get();

        return view(parent::loadDefaultVars($this->view_path . '.index'), compact('data'));
    }

    public function create()
    {
        return view(parent::loadDefaultVars($this->view_path . '.create'), compact('data'));
    }

    public function store(Request $request)
    {
        //dd($request->all());

        $data = [];

        $this->validate($request, [
            'file' => 'required|mimes:jpeg,png',
        ],
            $messages = [
                'required' => 'The :attribute field is required.',
                'mimes' => 'The :attribute of type jpeg, png',
            ]
        );
        $data['row'] = HomeSlider::create([
            'alt' => $request->alt_text,
            'product_link' => $request->link,
            /*'order' => $request->order,*/
            'status' => $request->status
        ]);
        if (!file_exists($this->image_url)) {
            mkdir($this->image_url);
        }
        if ($file = $request->file('file')) {
            $file_name = rand(1857, 9899) . '_' . $file->getClientOriginalName();
            $file->move($this->image_url, $file_name);
            $data['row']->title = $file_name;
            $data['row']->save();
        }
        return redirect()->route($this->base_route)->with('alert-success', 'Image saved successfully');
    }


    public function edit($id)
    {
        if (!$this->idExist($id)) {
            return redirect()->route($this->base_route)->with('alert-danger', 'Invalid Id');
        }

        $data = [];
        $data['row'] = $this->model;


        return view(parent::loadDefaultVars($this->view_path . '.edit'), compact('data'));
    }


    public function update(Request $request, $id)
    {
        if (!$this->idExist($id)) {
            return redirect()->route($this->base_route)->with('alert-danger', 'Invalid Id');
        }

        $data = $this->model;

        $data->update([
            'alt' => $request->alt_text,
            'product_link' => $request->link,
            'order' => $request->order,
            'status' => $request->status
        ]);

        if (!file_exists($this->image_url)) {
            mkdir($this->image_url);
        }

        if ($file = $request->file('file')) {

            //remove old image if new is uploaded
            if (!empty($data->title)) {
                $file_path = $this->image_url . $data->title;

                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }

            //upload new image
            $file_name = rand(1857, 9899) . '_' . $file->getClientOriginalName();
            $file->move($this->image_url, $file_name);
            $data->title = $file_name;
            $data->save();
        }

        return redirect()->route($this->base_route)->with('alert-success', 'Updated Successfully');
    }

    public function destroy($id)
    {

        if (!$this->idExist($id)) {
            return redirect()->route($this->base_route)->with('alert-danger', 'Invalid Id');
        }

        $data = $this->model;

        //remove image
        if (!empty($data->title)) {
            $file_path = $this->image_url . $data->title;

            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }

        $data::destroy($id);

        return redirect()->route($this->base_route)->with('alert-success', 'Deleted Successfully');


    }

    public function status($id)
    {

    }


    protected function idExist($id)
    {
        $this->model = HomeSlider::find($id);
        return $this->model;
    }
}

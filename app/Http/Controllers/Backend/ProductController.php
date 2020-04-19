<?php

namespace App\Http\Controllers\Backend;

use App\Product;
use App\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PrimaryCategory;

class ProductController extends BackendBaseController
{
    protected $base_route = 'backend.product';
    protected $view_path = 'backend.product';
    protected $model;


    public function __construct()
    {
        parent::__construct();

        $this->image_url = $this->image_url . 'products/';

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['rows'] = Product::OrderBy('primary_category_id','asc')->orderBy('title', 'asc')->paginate(15);
        $data['searchProducts'] = [];
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
        //dd($request->all());

        $this->validate($request, [
            'images.*' => 'required|mimes:jpeg,bmp,png|max:2000',
            'featured_image' => 'required|mimes:jpeg,bmp,png|max:2000',
            'title' => 'required',
            'features' => 'required',
            'description' => 'required',
        ]);

        $data = [];
        $data['row'] = Product::create([
            'title' => $request->get('title'),
            'primary_category_id' => $request->get('primary_category_id'),
            'secondary_category_id' => $request->get('secondary_category_id'),
            'features' => $request->get('features'),
            'is_featured' => $request->get('is_featured'),
            'description' => $request->get('description'),
            'price' => $request->get('price'),
            'stock' => $request->get('stock'),
            'status' => 1,
        ]);
        if (!file_exists($this->image_url)) {
            mkdir($this->image_url, 077, true);
        }
        if ($featured_image = $request->file('featured_image')) {
            $fname = rand(1857, 9899) . '_' . $featured_image->getClientOriginalName();
            $featured_image->move($this->image_url, $fname);
            $data['row']->featured_image = $fname;
            $data['row']->save();

        }
        if ($file = $request->file('images')) {
            foreach ($request->images as $image) {
                $file_name = rand(1857, 9899) . '_' . $image->getClientOriginalName();
                $image->move($this->image_url, $file_name);
                ProductImage::create([
                    'product_id' => $data['row']->id,
                    'title' => $file_name
                ]);

            }
        }

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
        $data['primary_category'] = PrimaryCategory::all();
        $data['secondary_category'] = $data['row']->PrimaryCategory->SecondaryCategories;
        $data['images'] = $data['row']->Images;

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
            'primary_category_id' => $request->get('primary_category_id'),
            'secondary_category_id' => $request->get('secondary_category_id'),
            'features' => $request->get('features'),
            'is_featured' => $request->get('is_featured'),
            'description' => $request->get('description'),
            'price' => $request->get('price'),
            'stock' => $request->get('stock'),
            'status' => 1,
        ]);

        if (!file_exists($this->image_url)) {
            mkdir($this->image_url, 077, true);
        }
        if ($featured_image = $request->file('featured_image')) {
            //delete previous image
            if (file_exists($this->image_url . $data->featured_image) && !empty($data->featured_image)) {
                @unlink($this->image_url . $data->featured_image);
            }

            $fname = rand(1857, 9899) . '_' . $featured_image->getClientOriginalName();
            $featured_image->move($this->image_url, $fname);
            $data->featured_image = $fname;
            $data->save();

        }
        if ($file = $request->file('images')) {
            foreach ($request->images as $image) {
                $file_name = rand(1857, 9899) . '_' . $image->getClientOriginalName();
                $image->move($this->image_url, $file_name);
                ProductImage::create([
                    'product_id' => $data->id,
                    'title' => $file_name
                ]);

            }
        }

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
        $images = Product::find($id)->Images;
        foreach ($images as $image) {
            if (file_exists($this->image_url . $image->title) && !empty($image->title)) {
                @unlink($this->image_url . $image->title);
            }
            $image->delete();
        }
        $result = Product::destroy($id);
        if ($result) {
            return redirect()->route($this->base_route)->with('alert-success', trans('backend/general.message.delete'));
        }
        return redirect()->route($this->base_route)->with('alert-danger', trans('backend/general.message.fail'));;


    }

    public function status($id)
    {
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
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyImage($id)
    {
        $image = ProductImage::find($id);
        if (file_exists($this->image_url . $image->title) && !empty($image->title)) {
            @unlink($this->image_url . $image->title);
        }
        $image->delete();

        return redirect()->back()->with('alert-success', trans('backend/general.message.delete'));
    }


    public function productSearch(Request $request)
    {


        $search = $request['searchQuery'];

        if (!empty($search)) {
            $data['rows'] = Product::orderBy('title', 'asc')->paginate(15);
            $data['searchProducts'] = Product::where('title', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%")
                ->paginate(15)
                ->appends(request()->query());

            return view(parent::loadDefaultVars($this->view_path . '.index'), compact('data'));
        }
    }


    /**
     * helper idExist class
     */
    public function idExist($id)
    {
        $this->model = Product::find($id);
        return $this->model;
    }
}

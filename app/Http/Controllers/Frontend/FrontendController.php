<?php

namespace App\Http\Controllers\Frontend;

use App\HomeSlider;
use App\PrimaryCategory;
use App\Product;
use App\SecondaryCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;

class FrontendController extends FrontendBaseController
{
    protected $view_path = 'frontend';


    /**
     * FrontendController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->image_url = $this->image_url . 'products/';

    }

    /**
     *
     * Index Page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = [];
        $data['featured_products'] = Product::where('is_featured', 1)->inRandomOrder()->limit(6)->get();
        $data['all_products'] = Product::where('status', 1)->inRandomOrder()->limit(6)->get();
        $data['categories'] = PrimaryCategory::get();
        $data['homeslider'] = HomeSlider::where('status', 1)->get();
        $data['searchProducts'] = '';
        return view(parent::loadDefaultVars($this->view_path . '.index'), compact('data'));
    }


    /**
     * Single Product Detail Page
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function productDetail($id)
    {
        $data = [];
        $data['row'] = Product::find($id);
        $data['categories'] = PrimaryCategory::get();
        return view(parent::loadDefaultVars($this->view_path . '.product-detail'), compact('data'));
    }


    /**
     * Product List
     *
     * @param $productType
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function productList($productType)
    {
        if (!empty($productType)) {
            $data = [];
            $data['type'] = $productType;
            switch ($productType) {
                case 'featured':
                    $data['products'] = Product::where('is_featured', 1)->where('status', 1)->orderByDesc('created_at')->get();
                    $data['categories'] = PrimaryCategory::get();
                    return view(parent::loadDefaultVars($this->view_path . '.all-products'), compact('data'));
                case 'all':
                    $data['products'] = Product::where('status', 1)->orderByDesc('created_at')->get();
                    $data['categories'] = PrimaryCategory::get();
                    return view(parent::loadDefaultVars($this->view_path . '.all-products'), compact('data'));
            }
        }
    }


    /**
     * Product List By Category
     *
     * @param $categoryType
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function productListByCategories($categoryType, $id)
    {
        if (!empty($categoryType)) {
            $data = [];
            $temp = [];
            switch ($categoryType) {
                case 'primary':
                    $data['secondaryCategory'] = SecondaryCategory::where('primary_category_id', $id)->get();
                    foreach ($data['secondaryCategory'] as $secondaryCategory) {
                        $temp[] = Product::where('secondary_category_id', $secondaryCategory->id)->where('status', 1)->get()->toArray();
                    }
                    $data['secondaryData'] = $temp;

                    //dd( $data['secondaryData']);
                    $data['categories'] = PrimaryCategory::get();

                    return view(parent::loadDefaultVars($this->view_path . '.productsbysubcategory'), compact('data'));
                case 'secondary':
                    $data['products'] = Product::where('secondary_category_id', $id)->where('status', 1)->orderByDesc('created_at')->get();
                    $data['categories'] = PrimaryCategory::get();
                    $data['secondaryCategory'] = SecondaryCategory::find($id)->title;
                    return view(parent::loadDefaultVars($this->view_path . '.productbycategory'), compact('data'));

            }
        }
    }

    public function productSearch(Request $request)
    {

        $search = $request['searchQuery'];
        if (!empty($search)) {
            $data['homeslider'] = HomeSlider::where('status', 1)->get();
            $data['categories'] = PrimaryCategory::get();
            $data['searchProducts'] = Product::where('title', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%")
                ->where('status', 1)
                ->get();
            return view(parent::loadDefaultVars($this->view_path . '.index'), compact('data'));
        }
    }


    /**
     * About Us
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function about()
    {
        $data = [];
        $data['categories'] = PrimaryCategory::get();
        return view(parent::loadDefaultVars($this->view_path . '.about'), compact('data'));
    }


    /**
     * Contact Us
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contact()
    {
        $data = [];
        $data['categories'] = PrimaryCategory::get();
        return view(parent::loadDefaultVars($this->view_path . '.contact'), compact('data'));
    }

    public function contactForm(Request $request)
    {

        $data = [];
        $data = $request->all();
        Mail::send('frontend.email.contact', ['m' => $data],
            function ($m) use ($data) {
                $m->to(Config::get('pk_security.mail.info'))->subject($data['subject']);
            });

        return response()->json(['success' => 'Message Sent Successfully']);
    }

    public function privacyPolicy()
    {
        $data = [];
        $data['categories'] = PrimaryCategory::get();
        return view(parent::loadDefaultVars($this->view_path . '.privacy_policy'),compact('data'));

    }
}

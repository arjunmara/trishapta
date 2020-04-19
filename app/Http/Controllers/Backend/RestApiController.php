<?php

namespace App\Http\Controllers\Backend;

use App\Client;
use App\HomeSlider;
use App\PrimaryCategory;
use App\Product;
use App\SecondaryCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;

class RestApiController extends BackendBaseController
{

    /**
     * Function to get categories with sub-categories
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCategoriesWithSubCategories()
    {
        //dd('api');
        $data = [];
        $primary = PrimaryCategory::select('id', 'title', 'description', 'created_at', 'updated_at')->get();
        //dd($primary);
        if (count($primary) > 0) {

            foreach ($primary as $row) {
                $row_array = $row->toArray();
                $row_array['sub_categories'] = (count($row->SecondaryCategories) > 0) ? $row->SecondaryCategories : '';
                $data[] = $row_array;
                //dd($temp);
            }
            //dd($data);
            return response()->json(['data' => $data, 'status' => 200]);

        }
    }

    /**
     * Function Returns All Categories
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCategories()
    {
        //dd('api');
        $data = [];
        $data['rows'] = PrimaryCategory::select('id', 'title', 'description', 'created_at', 'updated_at')->get();
        return response()->json(['data' => $data['rows'], 'status' => 200]);

    }

    /**
     * Function returns all subcategory by subcategory ID
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSubCategoriesByCategoryId($id)
    {
        //dd($id);
        $data = [];
        $data['rows'] = SecondaryCategory::select('id', 'title', 'description', 'created_at', 'updated_at')->where('primary_category_id', $id)->get();
        return response()->json(['data' => $data['rows'], 'status' => 200]);

    }

    /**
     * Function to get All Products
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllProducts()
    {
        $data = [];
        $data['rows'] = Product::all();
        return response()->json(['data' => $data['rows'], 'status' => 200]);
    }

    /**
     * Function to get Products Category by Id
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductByCategoryId($id)
    {
        $data = [];
        $data['rows'] = Product::where('primary_category_id', $id)->get();
        return response()->json(['data' => $data['rows'], 'status' => 200]);
    }


    public function getProductDetail($id)
    {
        $data = [];
        $data = Product::find($id);
        $data['images'] = $data->Images;

        return response()->json(['data' => $data, 'status' => 200]);
    }

    /**
     * Function to get product by subcategory Id
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductBySubCategoryId($id)
    {
        $data = [];
        $data['rows'] = Product::where('secondary_category_id', $id)->get();
        if (count($data['rows']) > 0) {
            foreach ($data['rows'] as $row) {
                $data['rows'][] = $row->Images;
            }
        }
        return response()->json(['data' => $data['rows'], 'status' => 200]);
    }

    /**
     * Home Slider API
     * @return \Illuminate\Http\JsonResponse
     */
    public function homeSlider()
    {
        $data = [];
        $data['rows'] = HomeSlider::get();
        return response()->json(['data' => $data['rows'], 'status' => 200]);
    }

    /**
     * Client Creation API
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createClient(Request $request)
    {
        $data = [];
        $data['rows'] = Client::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if ($data['rows']) {
            return response()->json(['data' => $data['rows'], 'status' => 200]);
        }

        return response()->json(['data' => "Sorry! An error occured, try again later!!", 'status' => 201]);
    }

    /**
     * Client Details Update API
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateClient(Request $request, $id)
    {
        $data = [];
        $data['rows'] = Client::find($id);
        $data['rows']->update([
            'name' => $request->name,
            'address' => $request->address,
            'sex' => $request->sex,
            'contact' => $request->contact,
            'date_of_birth' => $request->date_of_birth,
            'date_of_anniversary' => $request->date_of_anniversary,
            'office' => $request->office,
            'office_address' => $request->office_address,
        ]);


        if ($data['rows']) {
            return response()->json(['data' => $data['rows'], 'status' => 200]);
        }

        return response()->json(['data' => "Sorry! An error occured, try again later!!", 'status' => 201]);
    }

    /**
     * Client Password Reset API
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateClientPassword(Request $request, $id)
    {
        $data = [];
        $data['rows'] = Client::find($id);
        if (Hash::check($request->password, $data['rows']->password)) {
            $data['rows']->fill([
                'password' => Hash::make($request->newPassword)
            ])->save();

            return response()->json(['data' => 'Password has been changed successfully!', 'status' => 200]);

        } else {
            return response()->json(['data' => 'Old Password didnot match!', 'status' => 401]);
        }

    }

    public function about(Request $request)
    {

        $data['rows'] = [
            'about' => 'Trishapta Trading, is a B2B trading company, working to supply a complete FTTH and other networking solutions to its clients. Founded in 2017, it is operated by a team blended with veterans and young enthusiastic members. With the experience of more than 25 years on networking and communication fields, we know what this sector needs and thus deliver the quality goods in best price to clients.

Networking and communication is itself an ever evolving process. Lots of changes happens daily. Here, we at Trishapta, work hard to cope with these changes and introduce these latest technology to increase the efficiency and reliability.

“ETHICAL BUSINESS” is what we work for. Clients must get what they pay for. We believe on these values and operate accordingly. Turning point is just “START”, we will work together willingly afterward.'
        ];


        return response()->json(['data' => $data['rows'], 'status' => 200]);

    }

    public function contact(Request $request)
    {

        $data['rows'] = [
            'head_office' => [
                'companyname' => 'Trishapta Trading Pvt. Ltd',
                'address' => 'Shantipath, Tilotamma-32903',
                'telephone' => ['+977-071540211'],
                'mobile' => ['9857074266'],
                'email' => 'info@trishapta.com'
            ],
            'branches' => [
                [
                    'branch' => 'Trishapta Trading Pvt. Ltd.',
                    'address' => 'Butwal Branch',
                    'telephone' => [],
                    'mobile' => ['+977-9857074266, +977-9857073266'],
                    'email' => [],
                ],
                [
                    'branch' => 'Trishapta Trading Pvt. Ltd.',
                    'address' => 'Pokhara Branch',
                    'telephone' => ['+977-061-531912'],
                    'mobile' => ['+977-9857074266, +977-9857073266'],
                    'email' => [],
                ],

            ]

        ];


        return response()->json(['data' => $data['rows'], 'status' => 200]);

    }

    public function privacyPolicy()
    {
        return response()->json(['data' => view('frontend.pp-api')->render(), 'status' => 200]);
    }

}

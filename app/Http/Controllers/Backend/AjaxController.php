<?php

namespace App\Http\Controllers\Backend;

use App\PrimaryCategory;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use View;

class AjaxController extends BackendBaseController
{
    public function getSecondaryCategoryOnAjax(Request $request)
    {
        if ($request->ajax()) {
            if (!$request->id) {
                $renderHtml = '<option value="">No Option Available</option>';
                return response()->json(['data' => $renderHtml]);
            }
            $data['rows'] = PrimaryCategory::find($request->id)->SecondaryCategories;

            $renderHtml = View('backend.layouts.category-dropdown', compact('data'))->render();

            return response()->json(['data' => $renderHtml]);
        }

    }

    public function setStockStatusOnAjax(Request $request)
    {
        if ($request->ajax()) {
            if (!$request->pid) {
                return response()->json(['data' => 'Insufficient data for ajax call']);
            }

            $data['rows'] = Product::find($request->pid);
            $stockStatus = $data['rows']->stock == 0 ? 1 : 0;
            $data['rows']->update([
                'stock' => $stockStatus
            ]);

            return response()->json(['data' => 'Successfully Updated!']);
        }

        return response()->json(['data' => 'Invalid Ajax Call']);
    }

    public function setProductStatusOnAjax(Request $request)
    {
        if ($request->ajax()) {
            if (!$request->pid) {
                return response()->json(['data' => 'Insufficient data for ajax call']);
            }

            $data['rows'] = Product::find($request->pid);
            $status = $data['rows']->status == 0 ? 1 : 0;
            $data['rows']->update([
                'status' => $status
            ]);

            return response()->json(['data' => 'Successfully Updated!']);
        }

        return response()->json(['data' => 'Invalid Ajax Call']);
    }


}

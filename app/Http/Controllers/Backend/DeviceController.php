<?php

namespace App\Http\Controllers\Backend;

use App\Device;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeviceController extends BackendBaseController
{
    protected $base_route = 'backend.device';
    protected $view_path = 'backend.device';
    protected $model;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['rows'] = Device::paginate(15);
        return view(parent::loadDefaultVars($this->view_path . '.index'), compact('data'));

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
            'mac_id' => 'required',
            'device_token' => 'required',
            'device_type' => 'required'
        ]);

        $device = Device::where('mac_id', $request->mac_id)->first();
        if ($device) {
            $device->device_token = $request->device_token;
            $device->save();
            return response()->json(['data' => 'Device ID updated Successfully!', 'status' => 200]);
        } else {
            $device = Device::create([
                'mac_id' => $request->get('mac_id'),
                'device_token' => $request->get('device_token'),
                'device_type' => $request->get('device_type'),
            ]);
            return response()->json(['data' => 'Device ID Added Successfully!', 'status' => 200]);
        }

    }

}

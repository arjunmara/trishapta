<?php

namespace App\Http\Controllers\Backend;

use App\Device;
use App\PushNotification;
use Illuminate\Http\Request;



class PushNotificationController extends BackendBaseController
{
    protected $base_route = 'backend.push-notification';
    protected $view_path = 'backend.push-notification';
    protected $model;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['rows'] = PushNotification::paginate(15);
        return view(parent::loadDefaultVars($this->view_path . '.index'), compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $this->validate($request, [
            'title' => 'required|max:255',
            'body' => 'required',

        ]);

        $pushNotification = PushNotification::create([
            'title' => $request->get('title'),
            'body' => $request->get('body'),
        ]);

        //Load all device tokens
        $deviceTokens = Device::pluck('device_token')->toArray();

        //send code goes here..
        $push = new \Edujugon\PushNotification\PushNotification('fcm');
        $push->setMessage([
            'notification' => [
                'title' => $pushNotification->title,
                'body' => $pushNotification->body,
                'sound' => 'default'
            ],
        ])
            ->setDevicesToken($deviceTokens)
            ->send()
            ->getFeedback();

        if ($pushNotification) {
            return redirect()->route($this->base_route)->with('alert-success', trans('backend/general.message.save'));
        }
        return redirect()->route($this->base_route)->with('alert-danger', trans('backend/general.message.fail'));;

    }
}

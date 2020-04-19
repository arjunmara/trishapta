<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Client;
use Hash;

class ClientController extends BackendBaseController
{
    protected $base_route = 'backend.client';
    protected $view_path = 'backend.client';

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = [];
        $data['rows'] = Client::paginate(15);
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
            'name' => 'required|max:255',
            'email' => 'required|email|unique:clients',
            'password' => 'required',
            'address' => 'required',
            'contact' => 'required',

        ]);
        $data = [];
        $data['row'] = Client::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'address' => $request->get('address'),
            'contact' => $request->get('contact'),
            'date_of_birth' => $request->get('date_of_birth'),
            'sex' => $request->get('sex'),
            'date_of_anniversary' => $request->get('date_of_anniversary'),
            'office' => $request->get('office'),
            'office_address' => $request->get('office_address'),
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
        $data['row'] = Client::findOrFail($id);
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
            'name' => 'required|max:255',
            'email' => 'required|email|unique:clients,email,' . $id,
            'address' => 'required',
            'contact' => 'required',

        ]);

        $data = [];
        $data['row'] = Client::findOrFail($id);
        $data['row']->update([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'address' => $request->get('address'),
            'contact' => $request->get('contact'),
            'date_of_birth' => $request->get('date_of_birth'),
            'sex' => $request->get('sex'),
            'date_of_anniversary' => $request->get('date_of_anniversary'),
            'office' => $request->get('office'),
            'office_address' => $request->get('office_address'),
        ]);
        if ($request->has('password')) {
            $data['row']->update([
                'password' => Hash::make($request->get('password')),
            ]);
        }
        if ($data['row']) {
            return redirect()->route($this->base_route)->with('alert-success', trans('backend/general.message.update'));
        }
        return redirect()->route($this->base_route)->with('alert-danger', trans('backend/general.message.fail'));;

    }
}

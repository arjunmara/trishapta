<?php

namespace App\Http\Controllers\Backend;

use App\Branch;
use App\SiteConfig;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends BackendBaseController
{

    protected $base_route = 'backend.users';
    protected $view_path = 'backend.users';
    protected $home_route = 'backend.dashboard';
    protected $model;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['rows'] = User::where('branch_id', Auth::user()->branch_id)->paginate(15);
        return view(parent::loadDefaultVars($this->view_path . '.index'), compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];

        if (Auth::user()->hasRole('superadministrator|administrator')) {
            $data['rows'] = Branch::all();
        } else {
            $data['rows'] = Branch::where('id', Auth::user()->branch_id)->get();
        }

        $data['roles'] = Role::where(function ($query) {
            $query->where('user_level', '>=', min(parent::getUserLevel()));
        })->get();

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
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'branch_id' => 'required'
        ]);

        $data = [];
        $data['row'] = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'branch_id' => $request->get('branch_id'),
            'password' => Hash::make($request->get('password')),
        ]);

        if ($data['row']) {
            $data['row']->syncRoles($request->roles);
            SiteConfig::create([
                'key' => 'end_day',
                'value' => '0',
                'extra' => $data['row']->id
            ]);
            return redirect()->route($this->base_route)->with('alert-success', trans('backend/general.message.save'));
        }
        return redirect()->route($this->base_route)->with('alert-danger', trans('backend/general.message.fail'));

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
        $data['row'] = User::findOrFail($id);
        
        if (Auth::user()->hasRole('superadministrator|administrator')) {
            $data['branches'] = Branch::all();
        } else {
            $data['branches'] = Branch::where('id', Auth::user()->branch_id)->get();
        }

        $data['roles'] = Role::where(function ($query) {
            $query->where('user_level', '>=', min(parent::getUserLevel()));
        })->get();
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
            'email' => 'required|email|unique:users,email,' . $id,
            'branch_id' => 'required'

        ]);

        $data = [];
        $data['row'] = User::findOrFail($id);
        $data['row']->update([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'branch_id' => $request->get('branch_id'),
        ]);

        if ($data['row']) {
            $data['row']->syncRoles($request->roles);
            return redirect()->route($this->base_route)->with('alert-success', trans('backend/general.message.update'));
        }
        return redirect()->route($this->base_route)->with('alert-danger', trans('backend/general.message.fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect()->route($this->base_route)->with('alert-success', trans('backend/general.message.update'));;

    }

    /**
     * @GET
     * User Password Reset
     */

    public function passwordReset()
    {
        return view(parent::loadDefaultVars($this->view_path . '.password-reset'));
    }

    /**
     * @Post Method
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postPasswordReset(Request $request)
    {
        if (Hash::check($request->old_password, Auth::user()->password)) {
            //if old password matched, check for new password and confirm password match!
            if ($request->new_password == $request->confirm_password) {
                //change new password
                $user = User::find(Auth::user()->id);
                $user->password = Hash::make($request->new_password);
                $user->save();
                Auth::logout();
                return redirect()->route($this->home_route);
            } else {
                return redirect()->back()->with('alert-danger', 'New Password and Confirm Password Didn\'t match');
            }

        } else {
            return redirect()->route($this->base_route)->with('alert-success', 'Old Password didn\'t Match');
        }

    }
}

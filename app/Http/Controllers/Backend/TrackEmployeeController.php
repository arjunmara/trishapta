<?php

namespace App\Http\Controllers\Backend;

use App\Branch;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Schedule;
use Illuminate\Support\Facades\Auth;

class TrackEmployeeController extends BackendBaseController
{
    protected $base_route = 'backend.schedule';
    protected $view_path = 'backend.schedule';
    protected $sts_dashboard_path = 'backend.dashboard.sts';

    public function index()
    {
        $data = [];
        if (Auth::user()->can('track-employee-schedules')) {
            //if user has role of adminstrator or superadminstrator, load all baranches
            if (Auth::user()->hasRole(['superadministrator|administrator'])) {
                $data['branches'] = Branch::all();
            } else {
                $data['branches'] = collect([User::find(Auth::user()->id)->branch]);

            }
            return view(parent::loadDefaultVars($this->view_path . '.trackrecord'), compact('data'));
        } else {
            return redirect()->route($this->sts_dashboard_path)->with('alert-danger', trans('backend/general.message.unauthorized'));
        }
    }

    public function getEmployeeBasedOnBranch(Request $request)
    {
        if ($request->ajax()) {
            $data['rows'] = Branch::find($request->bid)->users;
            if ($data['rows']) {
                $renderHtml = View('backend.layouts.employee-dropdown', compact('data'))->render();
            } else {
                $renderHtml = '<option value="">No Option Available</option>';
            }
            return response()->json(['data' => $renderHtml]);
        }
    }

    public function getEmployeeTaskReport(Request $request)
    {

        if ($request->ajax()) {

            $startDate = explode(',', $request->daterange)[0];
            $endDate = explode(',', $request->daterange)[1];

            $data['rows'] = Schedule::orderBy('created_at', 'desc')
                ->where('created_by', $request->eid)
                ->where(function ($query) use ($request) {
                    switch ($request->task_status) {
                        case 'completed':
                            $query->where('task_status', 'yes');
                            break;
                        case 'incomplete':
                            $query->where('task_status', 'no');
                            break;
                        case 'pending':
                            $query->where('task_status', null);
                            break;
                    }
                })
                ->where(function ($query) use ($request) {
                    switch ($request->sales_status) {
                        case 'yes':
                            $query->where('sales_status', 'yes');
                            break;
                        case 'no':
                            $query->where('sales_status', 'no');
                            break;
                        case 'unknown':
                            $query->where('sales_status', null);
                            break;
                    }
                })
                ->where(function ($query) use ($startDate, $endDate) {
                    $query->whereBetween('created_at', [$startDate, $endDate]);
                })
                ->get();

            if ($data['rows']) {
                $renderHtml = View('backend.layouts.employee-report-table', compact('data'))->render();
            } else {
                $renderHtml = '<tr><td>No Data Available</td></tr>';
            }
            return response()->json(['data' => $renderHtml]);
        }
    }
}

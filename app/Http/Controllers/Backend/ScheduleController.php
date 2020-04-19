<?php

namespace App\Http\Controllers\Backend;

use App\Client;
use App\Notifications\EndDayNotification;
use App\Notifications\TodayTaskNotification;
use App\ResponseKeyword;
use App\Schedule;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\SiteConfig;

class ScheduleController extends BackendBaseController
{
    protected $base_route = 'backend.schedule';
    protected $view_path = 'backend.schedule';
    protected $sts_dashboard_path = 'backend.dashboard.sts';
    protected $model;
    protected $userId;


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('read-task')) {
            $data = [];
            $data['weeks'] = $this->createCalender();
            $data['rows'] = Schedule::orderBy('created_at', 'desc')
                ->where('created_by', Auth::user()->id)
                ->whereDate('created_at', Carbon::today())
                ->orWhereDate('next_followup_date', '=', Carbon::today())
                ->get();


            return view(parent::loadDefaultVars($this->view_path . '.index'), compact('data'));
        } else {
            return redirect()->route($this->sts_dashboard_path)->with('alert-danger', trans('backend/general.message.unauthorized'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        if (Auth::user()->can('create-task')) {
            //check if date is today
            if ($id != date('d')) {
                return redirect()->route($this->base_route)->with('alert-danger', trans('backend/general.message.date'));
            }
            $data['clients'] = Client::all();
            return view(parent::loadDefaultVars($this->view_path . '.create'), compact('data'));
        } else {
            return redirect()->route($this->sts_dashboard_path)->with('alert-danger', trans('backend/general.message.unauthorized'));

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->can('create-task')) {
            $this->validate($request, [
                'client_id' => 'required',
                'time' => 'required',
                'keynotes' => 'required',
                'visit_type' => 'required'
            ]);
            $data = [];
            $data['row'] = Schedule::create([
                'client_id' => $request->get('client_id'),
                'time' => $request->get('time'),
                'keynotes' => $request->get('keynotes'),
                'visit_type' => $request->get('visit_type'),
                'created_by' => Auth::user()->id,
            ]);

            if ($data['row']) {
                if ($request->has('submit')) {
                    return redirect()->route($this->base_route)->with('alert-success', trans('backend/general.message.save'));
                } else {
                    return redirect()->back()->with('alert-success', trans('backend/general.message.save'));
                }

            }
            return redirect()->route($this->base_route)->with('alert-danger', trans('backend/general.message.fail'));;
        } else {
            return redirect()->route($this->sts_dashboard_path)->with('alert-danger', trans('backend/general.message.unauthorized'));

        }

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
        if (Auth::user()->can('update-task')) {
            $data = [];
            $data['row'] = Schedule::findOrFail($id);
            $data['clients'] = Client::all();
            return view(parent::loadDefaultVars($this->view_path . '.edit'), compact('data'));
        } else {
            return redirect()->route($this->sts_dashboard_path)->with('alert-danger', trans('backend/general.message.unauthorized'));

        }
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
        if (Auth::user()->can('update-task')) {
            $this->validate($request, [
                'client_id' => 'required',
                'time' => 'required',
                'keynotes' => 'required',
                'visit_type' => 'required'

            ]);

            $data = [];
            $data['row'] = Schedule::findOrFail($id);
            $data['row']->update([
                'client_id' => $request->get('client_id'),
                'time' => $request->get('time'),
                'keynotes' => $request->get('keynotes'),
                'visit_type' => $request->get('visit_type'),
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
                'modified_at' => Carbon::now(),
            ]);
            if ($data['row']) {
                return redirect()->route($this->base_route)->with('alert-success', trans('backend/general.message.update'));
            }
            return redirect()->route($this->base_route)->with('alert-danger', trans('backend/general.message.fail'));
        } else {
            return redirect()->route($this->sts_dashboard_path)->with('alert-danger', trans('backend/general.message.unauthorized'));

        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allSchedule()
    {
        $data = [];
        $data['rows'] = Schedule::orderBy('created_at', 'desc')
            ->where('created_by', Auth::user()->id)
            ->get();
        return view(parent::loadDefaultVars($this->view_path . '.allschedule'), compact('data'));
    }

    /**
     * Get Feeback Form
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function feedback(Request $request)
    {
        $data = [];
        $data['response-keyword'] = ResponseKeyword::all();
        $data['task_id'] = $request->id;
        return view(parent::loadDefaultVars($this->view_path . '.feedback'), compact('data'));
    }

    /**
     * Storing Feedback
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeFeedback(Request $request)
    {
        $data = [];
        $data['row'] = Schedule::findorFail($request->taskId);
        if ($data['row']) {
            if ($request->has('task_status')) {
                //completed
                $data['row']->update([
                    'task_status' => 'yes',
                    'response_keyword' => $request->response_keyword_id,
                    'sales_status' => $request->sales_status,
                    'next_followup_date' => $request->next_followup_date,
                ]);
                //Create New task for next folloup date
                $this->CreateNewTask($data['row'], $request);
            } else {
                //not completed
                $data['row']->update([
                    'task_status' => 'no',
                    'reason' => $request->reason,
                    'next_followup_date' => $request->next_followup_date
                ]);
                //Create New task for next folloup date
                $this->CreateNewTask($data['row'], $request);
            }
            return redirect()->route($this->base_route)->with('alert-success', trans('backend/general.message.update'));
        }
        return redirect()->route($this->base_route)->with('alert-danger', trans('backend/general.message.fail'));
    }

    /**
     * Create New Task Based on Next Followup Date
     * @param $task
     * @param $request
     */
    private function createNewTask($task, $request)
    {
        $data = [];
        $data['row'] = Schedule::create([
            'client_id' => $task->client_id,
            'time' => 'Not Set',
            'keynotes' => 'Not Set',
            'visit_type' => 'Not Set',
            'next_followup_date' => $request->next_followup_date . ' ' . '00:00:00',
            'created_by' => Auth::user()->id,
            'created_at' => null,
            'updated_at' => null,
        ]);
    }

    private function createCalender()
    {
        date_default_timezone_set('Asia/Kathmandu');
        // Get prev & next month
        if (isset($_GET['ym'])) {
            $ym = $_GET['ym'];
        } else {
            // This month
            $ym = date('Y-m');
        }
        // Check format
        $timestamp = strtotime($ym . '-01');
        if ($timestamp === false) {
            $ym = date('Y-m');
            $timestamp = strtotime($ym . '-01');
        }
        // Today
        $today = date('Y-m-j', time());
        // For H3 title
        $html_title = date('Y / m', $timestamp);
        // Create prev & next month link     mktime(hour,minute,second,month,day,year)
        $prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp) - 1, 1, date('Y', $timestamp)));
        $next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp) + 1, 1, date('Y', $timestamp)));
        // You can also use strtotime!
        // $prev = date('Y-m', strtotime('-1 month', $timestamp));
        // $next = date('Y-m', strtotime('+1 month', $timestamp));
        // Number of days in the month
        $day_count = date('t', $timestamp);

        // 0:Sun 1:Mon 2:Tue ...
        $str = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));

        //$str = date('w', $timestamp);
        // Create Calendar!!
        $weeks = array();
        $week = '';
        // Add empty cell
        $week .= str_repeat('<td></td>', $str);
        for ($day = 1; $day <= $day_count; $day++, $str++) {

            $date = $ym . '-' . $day;

            if ($today == $date) {
                $week .= '<td class="today">' . $day . ' <a href="' . route("backend.schedule.add", $day) . '" class="btn btn-xs btn-primary"><i class="fa fa-plus"></i> Add Task</a>';
            } else {
                $week .= '<td>' . $day;
            }
            $week .= '</td>';

            // End of the week OR End of the month
            if ($str % 7 == 6 || $day == $day_count) {
                if ($day == $day_count) {
                    // Add empty cell
                    $week .= str_repeat('<td></td>', 6 - ($str % 7));
                }
                $weeks[] = '<tr>' . $week . '</tr>';
                // Prepare for new week
                $week = '';
            }

        }
        return $weeks;

    }

}

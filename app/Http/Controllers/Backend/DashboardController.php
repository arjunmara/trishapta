<?php

namespace App\Http\Controllers\Backend;

use App\PrimaryCategory;
use App\Product;
use App\Schedule;
use App\SecondaryCategory;
use App\SiteConfig;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class DashboardController extends BackendBaseController
{
    /**
     * Trishapta Website Dashboard
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = [];
        $data['products'] = Product::all()->count();
        $data['primary_category'] = PrimaryCategory::all()->count();
        $data['secondary_category'] = SecondaryCategory::all()->count();
        return view('backend.dashboard', compact('data'));
    }

    /**
     * Sales Tracking System - Personal Dashboard
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sts()
    {

        $data = [];
        $data['today_task'] = Schedule::orderBy('created_at', 'desc')
            ->where('created_by', Auth::user()->id)
            ->whereDate('created_at', Carbon::today())
            ->orWhereDate('next_followup_date', '=', Carbon::today())
            ->get();
        $data['upcoming_task'] = Schedule::orderBy('next_followup_date', 'asc')
            ->where('created_by', Auth::user()->id)
            ->whereDate('next_followup_date', '>', Carbon::today())
            ->get();
        $data['task_completed'] = Schedule::orderBy('created_at', 'desc')
            ->where('created_by', Auth::user()->id)
            ->where('task_status', 'yes')
            ->get();
        $data['task_incomplete'] = Schedule::orderBy('created_at', 'desc')
            ->where('created_by', Auth::user()->id)
            ->where('task_status', 'no')
            ->get();

        $data['end_day'] = SiteConfig::where('key', 'end_day')
            ->where('extra', Auth::user()->id)
            ->get()[0];


        /**
         * Total Sales Rate in Last 30 Days
         */
        $data['total_sales_in_30_days'] = Schedule::where('created_by', Auth::user()->id)
            ->where('sales_status', 'yes')
            ->where('created_at', '>', Carbon::now()->subDays(30))
            ->count();
        $data['total_visits_in_30_days'] = Schedule::where('created_by', Auth::user()->id)
            ->where('task_status', 'yes')
            ->where('created_at', '>', Carbon::now()->subDays(30))
            ->count();
        $data['sales_rate_in_30_days'] = parent::calculatePercentage($data['total_sales_in_30_days'], $data['total_visits_in_30_days']);


        /**
         * Total Task Completion Rate in Last 30 Days
         */
        $data['task_completed_in_30_days'] = Schedule::where('created_by', Auth::user()->id)
            ->where('task_status', 'yes')
            ->where('created_at', '>', Carbon::now()->subDays(30))
            ->count();
        $data['total_tasks_in_30_days'] = Schedule::where('created_by', Auth::user()->id)
            ->where('task_status', 'yes')
            ->orWhere('task_status', 'no')
            ->where('created_at', '>', Carbon::now()->subDays(30))
            ->count();
        $data['task_completion_rate_in_30_days'] = parent::calculatePercentage($data['task_completed_in_30_days'], $data['total_tasks_in_30_days']);

        /**
         * Total Counts Till Date
         */

        $data['total_sales_till_date'] = $data['total_sales_in_30_days'] = Schedule::where('created_by', Auth::user()->id)
            ->where('sales_status', 'yes')
            ->count();
        $data['total_visits_till_date'] = $data['total_visits_in_30_days'] = Schedule::where('created_by', Auth::user()->id)
            ->where('task_status', 'yes')
            ->count();
        $data['cancelled_visits_till_date'] = $data['total_visits_in_30_days'] = Schedule::where('created_by', Auth::user()->id)
            ->where('task_status', 'no')
            ->count();
        $data['upcoming_visits'] = Schedule::orderBy('next_followup_date', 'asc')
            ->whereDate('next_followup_date', '>', Carbon::today())
            ->where('created_by', Auth::user()->id)
            ->count();
        return view('backend.sts-dashboard', compact('data'));
    }

    /**
     * @param $nid
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function markAsReadNotification($nid)
    {
        $notification = parent::markAsReadNotification($nid);

        if ($notification->type == 'App\Notifications\TodayTaskNotification') {
            return redirect()->route('backend.schedule');
        } elseif ($notification->type == 'App\Notifications\EndDayNotification') {
            return redirect()->route('backend.dayend');
        }

    }

    /**
     * User Logout
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('backend.dashboard');
    }

}

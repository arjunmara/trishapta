<?php

namespace App\Http\Controllers\Backend;

use App\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends BackendBaseController
{

    public function index()
    {
        $data = [];

        $data['total_visits_this_year'] = Schedule::whereYear('created_at', date('Y)'))
            ->where('task_status', 'yes')
            ->count();

        $data['total_sales_this_year'] = Schedule::whereYear('created_at', date('Y)'))
            ->where('sales_status', 'yes')
            ->count();

        $data['feedback_based_on_keyword'] = array_count_values(Schedule::join('response_keywords', 'schedules.response_keyword', '=', 'response_keywords.id')
            ->whereYear('schedules.created_at', date('Y'))
            ->where('schedules.response_keyword', '<>', null)
            ->pluck('response_keywords.title')->toArray());

        $data['total_visits_by_month'] = Schedule::whereYear('created_at', date('Y'))
            ->where('task_status', '<>', null)
            ->where('task_status', '<>', 'yes')
            ->get();
        if ($data['total_visits_by_month']) {
            $total_visits_by_month = $this->prepareBarGraphDataMonthWise($data['total_visits_by_month']);
        }
        $data['total_sales_by_month'] = Schedule::whereYear('created_at', date('Y'))
            ->where('sales_status', '<>', null)
            ->where('sales_status', '<>', 'yes')
            ->get();
        if ($data['total_sales_by_month']) {
            $total_sales_by_month = $this->prepareBarGraphDataMonthWise($data['total_sales_by_month']);
        }
        $data['monthly_visits_vs_sales'] = ['visits' => $total_visits_by_month, 'sales' => $total_sales_by_month];

        return view('backend.report-dashboard', compact('data'));
    }

    private function prepareBarGraphDataMonthWise($monthly_data)
    {
        /**
         * Reset Months data
         */
        $result = array(
            'jan' => 0,
            'feb' => 0,
            'mar' => 0,
            'apr' => 0,
            'may' => 0,
            'jun' => 0,
            'jul' => 0,
            'aug' => 0,
            'sep' => 0,
            'oct' => 0,
            'nov' => 0,
            'dec' => 0
        );

        foreach ($monthly_data as $datum) {
            switch (explode('-', $datum->created_at)[1]) {
                case '01':
                    $result['jan'] = $result['jan'] + 1;
                    break;
                case '02':
                    $result['feb'] = $result['feb'] + 1;
                    break;
                case '03':
                    $result['mar'] = $result['mar'] + 1;
                    break;
                case '04':
                    $result['apr'] = $result['apr'] + 1;
                    break;
                case '05':
                    $result['may'] = $result['may'] + 1;
                    break;
                case '06':
                    $result['jun'] = $result['jun'] + 1;
                    break;
                case '07':
                    $result['jul'] = $result['jul'] + 1;
                    break;
                case '08':
                    $result['aug'] = $result['aug'] + 1;
                    break;
                case '09':
                    $result['sep'] = $result['sep'] + 1;
                    break;
                case '10':
                    $result['oct'] = $result['oct'] + 1;
                    break;
                case '11':
                    $result['nov'] = $result['nov'] + 1;
                    break;
                case '12':
                    $result['dec'] = $result['dec'] + 1;
                    break;
            }
        }
        return $result;
    }

}

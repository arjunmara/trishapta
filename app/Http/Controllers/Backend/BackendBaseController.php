<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\AppBaseController;
use App\Schedule;
use Carbon\Carbon;
use View;
use App\SiteConfig;
use Illuminate\Support\Facades\Auth;

class BackendBaseController extends AppBaseController
{
    protected $pagination_limit = 20;
    protected $image_url;
    protected $userId;
    protected $user;

    /**
     * BackendBaseController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->image_url = config('pk_security.url.backend.image');
    }


    /**
     *
     * Get Dimension of Images
     * @param $width
     * @param $height
     * @return string
     */
    protected function getDimentaion($width, $height)
    {
        if ($width > $height)
            $image_dimension = 'wide';
        elseif ($width == $height)
            $image_dimension = 'square';
        else
            $image_dimension = 'height';

        return $image_dimension;
    }


    /**
     * Load defaults variables for views
     * @param $view_path
     * @return mixed
     */
    protected function loadDefaultVars($view_path)
    {
        View::composer($view_path, function ($view) use ($view_path) {

            $view->with('image_url', $this->image_url);
            $view->with('base_route', $this->base_route);
            $view->with('trans_path', $this->makeTranslationPath($view_path));
            $view->with('pagination_limit', $this->pagination_limit);
        });

        return $view_path;

    }

    /**
     * View Path Translation
     * @param $view_path
     * @return string
     */
    public function makeTranslationPath($view_path)
    {
        $tmp = explode('.', $view_path);
        array_pop($tmp);
        return implode('/', $tmp) . '/';
    }

    /**
     * Get Key Value Pair for dropdown options
     * @param $datas
     * @param $option_value
     * @param $option_text
     * @return array
     */
    protected function getArrayForDropdown($datas, $option_value, $option_text)
    {
        $tmp = [];
        foreach ($datas as $key => $data) {
            $tmp[$data->$option_value] = $data->$option_text;
        }

        return $tmp;
    }

    /**
     * Get Array By Keys
     * @param Collection $data
     * @param $key
     * @return array
     */
    protected function getArrayByKey(Collection $data, $key)
    {
        $tmp = [];
        foreach ($data as $item) {
            $tmp[] = $item->$key;
        }

        return $tmp;
    }

    /**
     *
     * Day End
     * @return \Illuminate\Http\RedirectResponse
     */
    public function EndDay()
    {
        //dd('here');
        $pendingTasks = Schedule::where('created_by', Auth::user()->id)
            ->where('task_status', null)
            ->first();
        if ($pendingTasks) {
            return redirect()->back()->with('alert-danger', 'Before you end your day, Please attempt all your pending tasks!');
        }
        $EndDay = SiteConfig::where('key', 'end_day')
            ->where('extra', Auth::user()->id)
            ->get();
        if ($EndDay[0]->value == 0) {
            $EndDay[0]->value = 1;
            $EndDay[0]->save();
        }
        return redirect()->back()->with('alert-success', trans('backend/general.message.save'));
    }

    /**
     * Percentage Calculator
     * @param $numerator
     * @param $denominator
     * @return int|string
     */
    public function calculatePercentage($numerator, $denominator)
    {
        if ($denominator != 0) {

            $percentage = ($numerator / $denominator) * 100;

            return bcdiv($percentage, 1, 2);
        }

        return 0;
    }

    /**
     *  Notification mark as read
     * @param $nid
     * @return mixed
     */
    public function markAsReadNotification($nid)
    {
        $notification = Auth::user()->unReadNotifications->find($nid);
        if ($notification) {
            $notification->markAsRead();
        }
        return $notification;
    }

    /**
     * Get User Level
     * @return array
     */
    public function getUserLevel()
    {
        $user_level = array();
        foreach (Auth()->user()->roles as $role) {
            $user_level[] = $role->user_level;
        }
        return $user_level;
    }
}

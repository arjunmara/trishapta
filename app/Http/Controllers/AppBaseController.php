<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AppBaseController extends Controller
{
    public function __construct()
    {
        if (app()->environment() !== 'production')
            DB::enableQueryLog();
    }

    public function makeViewFolderPath($view_path)
    {
        $tmp = explode('.', $view_path);
        array_pop($tmp);
        return implode('/', $tmp).'/';
    }
}

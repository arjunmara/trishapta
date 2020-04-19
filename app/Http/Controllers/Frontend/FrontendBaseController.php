<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
class FrontendBaseController extends AppBaseController
{


    protected $pagination_limit = 20;
    protected $image_url;

    /**
     * FrontBaseController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->image_url = config('pk_security.url.backend.image');
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
           /* $view->with('base_route', $this->base_route);*/
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
        return implode('/', $tmp).'/';
    }
}

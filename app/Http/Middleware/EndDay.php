<?php

namespace App\Http\Middleware;

use Closure;
use App\SiteConfig;
use Illuminate\Support\Facades\Auth;
class EndDay
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $data['end_day'] = SiteConfig::where('key', 'end_day')
            ->where('extra', Auth::user()->id)
            ->get()[0];
        if ($data['end_day']->value == 1) {
            return redirect()->back()->with('alert-warning', 'Sorry! You cannot perform this task because you have end the day for today.');
        }
        return $next($request);
    }
}

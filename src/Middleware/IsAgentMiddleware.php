<?php

namespace Binshops\LaravelTicket\Middleware;

use Closure;
use Binshops\LaravelTicket\Models\Agent;
use Binshops\LaravelTicket\Models\Setting;

class IsAgentMiddleware
{
    /**
     * Run the request filter.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Agent::isAgent() || Agent::isAdmin()) {
            return $next($request);
        }

        return redirect()->route(Setting::grab('main_route'). '.index')
            ->with('warning', trans('laravelticket::lang.you-are-not-permitted-to-access'));
    }
}

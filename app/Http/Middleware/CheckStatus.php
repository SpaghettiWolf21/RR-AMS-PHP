<?php
/*
* Racing R Attendance Monitoring System
*/
namespace App\Http\Middleware;

use Closure;
use View;
use App\Classes\table;

class CheckStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $status = \Auth::user()->status;
        if ($status==null || $status==0) {
            \Auth::logout();
            return redirect()->route('disabled');
        } 

        $role_id = \Auth::user()->role_id;
        if ($role_id==null || $role_id==0) {
            \Auth::logout();
            return redirect()->route('notfound');
        }
        
        return $next($request);
    }
}

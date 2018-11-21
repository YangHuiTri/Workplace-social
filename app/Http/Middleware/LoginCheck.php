<?php

namespace App\Http\Middleware;

use Closure;

class LoginCheck
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
        //判断后台是否登录
        if(session('loginType')){
            return $next($request);
        }else{
            return redirect('/home/login/index')->withErrors([
                'loginError'    =>  '您还未登录，请登录！'
            ]);
        }
    }
}

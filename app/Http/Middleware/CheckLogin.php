<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
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

        $account = session('account');
        if(!$account){
            echo "<script>alert('请先登录');location.href='/login'</script>";
        }
        return $next($request);
    }
}

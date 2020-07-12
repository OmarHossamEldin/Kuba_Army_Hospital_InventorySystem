<?php

namespace App\Http\Middleware;

use Closure;

class SaftyQuestion
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
        if(count(auth()->user()->saftyquestion)===0){ 
            return redirect('\saftyquestion/create')->with('error','برجاء اجاة سؤال الامان');
        }
        else{
            return $next($request);
        }
    }
}

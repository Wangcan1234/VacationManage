<?php
namespace App\Http\Middleware;
use Closure;
class activity{

public function handle($request,Closure $next){
    if(time()<strtotime('2017-07-16')) {
        return redirect('activity0');
    }
    else{
        return $next($request);
    }

}
}
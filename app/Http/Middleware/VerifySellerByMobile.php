<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use \Detection\MobileDetect as Mobile;
use Illuminate\Support\Facades\Auth;

class VerifySellerByMobile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $appProduction = env('APP_DEBUG', false);

        if (Auth::user()->profile === User::SALESMAN && $appProduction === false) {
            $detect = new Mobile;
            if (!$detect->isMobile() && !$detect->isTablet()) {
                Auth::logout();
                return response()->json(["message" => "Sellers can only access this system via a mobile application"]);
            } else {
                return $next($request);
            }
        }

        return $next($request);
    }
}

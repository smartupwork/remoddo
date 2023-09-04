<?php

namespace App\Http\Middleware;

use App\Models\ProductView;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductViewMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->check() && auth()->user()->products->contains($request->product)){
            return $next($request);
        }else{
            $request->product->views()->save(new ProductView([
                'ip_address' => $request->ip()
            ]));
            return $next($request);
        }
    }
}

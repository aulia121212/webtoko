<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckShopAccess
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        // Pastikan user adalah admin dan memiliki shop_id
        if ($user->level === 'Admin' && $user->shop_id) {
            // Filter data berdasarkan shop_id
            $request->merge(['shop_id' => $user->shop_id]);
        }

        return $next($request);
    }
}

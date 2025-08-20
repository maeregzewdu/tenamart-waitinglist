<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CaptureUtm
{
    public function handle(Request $request, Closure $next)
    {

        \Log::info('CaptureUtm ran', [
            'utm_source' => $request->query('utm_source'),
            'all_query'  => $request->query()
        ]);
        $utmKeys = ['utm_source','utm_medium','utm_campaign','utm_term','utm_content'];
        $found = [];

        foreach ($utmKeys as $k) {
            if ($val = $request->query($k)) {
                $found[$k] = $val;
            }
        }

        // capture referer if present
        if ($referer = $request->headers->get('referer')) {
            $found['referrer'] = $referer;
        }

        if (!empty($found)) {
            
            $request->session()->put('utm_data', $found);
            Cookie::queue(cookie()->forever('utm_data', json_encode($found)));
        }
        
    
        return $next($request);
    }
}

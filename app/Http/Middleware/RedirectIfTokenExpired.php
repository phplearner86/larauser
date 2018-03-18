<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfTokenExpired
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
        if ($request->activationToken->hasExpired()) 
        {
            return $this->failedResponse();
        }

        return $next($request);
    }

    protected function failedResponse()
    {
        $response = message('Your activation period has expired. Please Register again.', 'error');

        return redirect()->route('index')->with($response);
    } 
}

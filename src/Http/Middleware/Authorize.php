<?php

namespace Ijpatricio\NovaLarastanTool\Http\Middleware;

use Ijpatricio\NovaLarastanTool\NovaLarastanTool;

class Authorize
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response
     */
    public function handle($request, $next)
    {
        return resolve(NovaLarastanTool::class)->authorize($request) ? $next($request) : abort(403);
    }
}

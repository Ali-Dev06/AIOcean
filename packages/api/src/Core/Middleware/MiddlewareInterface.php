<?php

declare(strict_types=1);

namespace App\Core\Middleware;

use App\Core\Request;
use App\Core\Response;

interface MiddlewareInterface
{
    /**
     * Handle the request.
     *
     * Call $next($request) to pass to the next middleware or the final handler.
     *
     * @param  Request  $request
     * @param  callable(Request): Response  $next
     * @return Response
     */
    public function handle(Request $request, callable $next): Response;
}

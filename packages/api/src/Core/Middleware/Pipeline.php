<?php

declare(strict_types=1);

namespace App\Core\Middleware;

use App\Core\Request;
use App\Core\Response;

/**
 * Onion-style middleware pipeline.
 *
 * Wraps each middleware around the next, executing them in order.
 */
final class Pipeline
{
    /** @var MiddlewareInterface[] */
    private array $middleware = [];

    public function pipe(MiddlewareInterface $middleware): self
    {
        $this->middleware[] = $middleware;
        return $this;
    }

    /**
     * Run the pipeline with a final handler at the core.
     *
     * @param  Request  $request
     * @param  callable(Request): Response  $handler
     * @return Response
     */
    public function run(Request $request, callable $handler): Response
    {
        $pipeline = array_reduce(
            array_reverse($this->middleware),
            function (callable $next, MiddlewareInterface $middleware): callable {
                return fn(Request $req) => $middleware->handle($req, $next);
            },
            $handler
        );

        return $pipeline($request);
    }
}

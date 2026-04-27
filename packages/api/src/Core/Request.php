<?php

declare(strict_types=1);

namespace App\Core;

/**
 * Wraps PHP superglobals into a clean object.
 */
final class Request
{
    private array $query;
    private array $body;
    private array $server;
    private array $headers;
    private array $routeParams = [];

    public function __construct()
    {
        $this->query  = $_GET;
        $this->server = $_SERVER;
        $this->headers = $this->parseHeaders();
        $this->body = [];
    }

    // --- Getters ---

    public function method(): string
    {
        return strtoupper($this->server['REQUEST_METHOD'] ?? 'GET');
    }

    public function path(): string
    {
        $uri = $this->server['REQUEST_URI'] ?? '/';
        $path = parse_url($uri, PHP_URL_PATH);
        return $path ?: '/';
    }

    public function query(string $key, mixed $default = null): mixed
    {
        return $this->query[$key] ?? $default;
    }

    public function allQuery(): array
    {
        return $this->query;
    }

    public function input(string $key, mixed $default = null): mixed
    {
        return $this->body[$key] ?? $this->query[$key] ?? $default;
    }

    public function all(): array
    {
        return array_merge($this->query, $this->body);
    }

    public function header(string $key, mixed $default = null): mixed
    {
        $normalized = strtolower($key);
        return $this->headers[$normalized] ?? $default;
    }

    // --- Route params ---

    public function param(string $key, mixed $default = null): mixed
    {
        return $this->routeParams[$key] ?? $default;
    }

    public function setRouteParams(array $params): void
    {
        $this->routeParams = $params;
    }

    // --- Body parsing ---

    public function setBody(array $body): void
    {
        $this->body = $body;
    }

    public function body(): array
    {
        return $this->body;
    }

    // --- Internal ---

    private function parseHeaders(): array
    {
        $headers = [];
        foreach ($this->server as $key => $value) {
            if (str_starts_with($key, 'HTTP_')) {
                $name = strtolower(str_replace('_', '-', substr($key, 5)));
                $headers[$name] = $value;
            }
        }
        if (isset($this->server['CONTENT_TYPE'])) {
            $headers['content-type'] = $this->server['CONTENT_TYPE'];
        }
        return $headers;
    }
}

<?php

declare(strict_types=1);

/**
 * Front controller — single entry point for all API requests.
 *
 * Usage: php -S localhost:8080 -t public/
 */

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Application;

$basePath = dirname(__DIR__);

try {
    $app = new Application($basePath);
    $app->run();
} catch (\Throwable $e) {
    // Show errors in development, hide in production
    $debug = ($_ENV['APP_DEBUG'] ?? 'true') === 'true';

    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode([
        'error'   => 'Internal server error',
        'message' => $debug ? $e->getMessage() : null,
        'trace'   => $debug ? $e->getTraceAsString() : null,
    ]);
}

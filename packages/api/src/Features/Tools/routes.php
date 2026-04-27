<?php

declare(strict_types=1);

use App\Core\Router;
use App\Features\Tools\ToolController;

Router::get('/api/tools',      [ToolController::class, 'index']);
Router::get('/api/tools/{id}', [ToolController::class, 'show']);
Router::get('/api/categories', [ToolController::class, 'categories']);


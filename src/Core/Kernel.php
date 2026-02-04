<?php

namespace Bpjs\Core;
use Bpjs\Framework\Helpers\Api;
use Bpjs\Framework\Helpers\Route;
use Bpjs\Framework\Helpers\View;

class Kernel
{
    protected array $middleware = [
        \Bpjs\Framework\Helpers\CORSMiddleware::class,
    ]; 
    protected string $dispatcherType = 'web';

    public function __construct(protected App $app)
    {
        $this->mapRoutes();
    }

    protected function mapRoutes(): void
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); 
        $appBasePath = app_base_path();
        $cleanUri = preg_replace('#^' . preg_quote($appBasePath, '#') . '#', '', $uri);
        $cleanUri = '/' . ltrim($cleanUri, '/');

        $apiPrefix = '/api';

        if (str_starts_with($cleanUri, $apiPrefix)) {
            $this->dispatcherType = 'api';
            Api::init(api_prefix());
            require BPJS_BASE_PATH . '/routes/api.php';
        } else {
            $this->dispatcherType = 'web';
            Route::init($appBasePath);
            require BPJS_BASE_PATH . '/routes/web.php';
        }
    }

    public function handle(Request $request): Response
    {
        foreach ($this->middleware as $middleware) {
            (new $middleware())->handle($request);
        }
        return match ($this->dispatcherType) {
            'web' => Route::dispatch(),
            'api' => Api::dispatch(),
            default => new \Bpjs\Core\Response('Dispatcher not found', 500)
        };
    }

    public function terminate(): void
    {
        // Bisa untuk logging, session cleanup, dsb.
    }

    public function addMiddleware(string $class): void
    {
        $this->middleware[] = $class;
    }
}

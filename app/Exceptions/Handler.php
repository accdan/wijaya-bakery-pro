<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            // Log all errors for monitoring
            Log::error('Application Error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'url' => request()->fullUrl(),
                'user_agent' => request()->userAgent(),
                'ip' => request()->ip(),
            ]);
        });

        // Custom error page for production
        $this->renderable(function (Throwable $e, $request) {
            // Only show custom error page in production
            if (app()->environment('production')) {
                // Return custom error view instead of Laravel debug info
                if ($request->expectsJson()) {
                    return response()->json([
                        'message' => 'Internal Server Error',
                        'status' => 500
                    ], 500);
                }

                return response()->view('errors.500', [], 500);
            }

            // In development, let Laravel handle it normally
            return null;
        });

        // Handle 404 errors
        $this->renderable(function (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Not Found'], 404);
            }

            return response()->view('errors.404', [], 404);
        });

        // Handle 403 errors
        $this->renderable(function (\Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Forbidden'], 403);
            }

            return response()->view('errors.403', [], 403);
        });
    }
}


<?php

namespace TungNN\LaravelBase\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use TungNN\LaravelBase\ErrorMessage;

class ResponseServiceProvider extends ServiceProvider
{
    /**
     * Array of http-status code and text.
     *
     * @var array|string[]
     */
    private array $statusTexts = [
        200 => 'Success',
        201 => 'Created',
        202 => 'Accepted',
        204 => 'No Content',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        403 => 'Forbidden',
        404 => 'Not Found',
        500 => 'Internal Server Error',
    ];

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $statusTexts = collect($this->statusTexts)->map(function ($value) {
            return Str::of($value)->trim()->prepend('json')->camel();
        });

        foreach ($statusTexts as $statusCode => $statusText) {
            Response::macro($statusText, function ($result, $headers) use ($statusCode) {
                if ($statusCode < 200 || $statusCode >= 300) {
                    $result = new ErrorMessage($result);
                }

                Response::json($result, $statusCode, $headers);
            });
        }
    }
}

<?php

namespace App\Exceptions;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            return Controller::jsonFailResponseStatic(
                message: 'Something went wrong.',
                code: 500
            );
        });
        

        $this->renderable(function (QueryException $e) {
            return Controller::jsonFailResponseStatic(
                message: 'Something went wrong.',
                code: 500
            );
        });

        $this->renderable(function (MethodNotAllowedHttpException $e) {
            return Controller::jsonFailResponseStatic(
                message: $e->getMessage(),
                code: 404
            );
        });

        $this->renderable(function (ModelNotFoundException $e) {
            return Controller::jsonFailResponseStatic(
                message: 'Record not found.',
                code: 404
            );
        });

        $this->renderable(function (RouteNotFoundException $e) {
            return Controller::jsonFailResponseStatic(
                message: 'Route not found.',
                code: 404
            );
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $e
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $e)
    {
        // Override for Model::findOrFail if header 'Accept: application/json' is pressent
        if ($request->expectsJson()) {
            if ($e instanceof ModelNotFoundException) {
                return Controller::jsonFailResponseStatic(
                    message: 'Record not found.',
                    code: 404
                );
            }
        }

        return parent::render($request, $e);
    }
}

<?php

namespace App\Exceptions;

use App\Response\ResponseApi;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Kreait\Firebase\Exception\Messaging as MessagingErrors;
use Kreait\Firebase\Exception\Messaging\InvalidMessage;
use Kreait\Firebase\Exception\MessagingException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
            //
        });
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $this->shouldReturnJson($request, $exception)
                    ? response()->json([
                        'status' => "failed",
                        'message' => $exception->getMessage()
                    ], 401)
                    : redirect()->guest($exception->redirectTo() ?? route('login'));
    }
    // public function render($request, Throwable $exception)
    // {
    //     if ($exception instanceof InvalidMessage) {
    //         return ResponseApi::error($exception->getMessage(), 422);
    //     }else if ($exception instanceof MessagingErrors\NotFound) {
    //         return ResponseApi::error($exception->getMessage(), 422);
    //     }else if ($exception instanceof MessagingErrors\ServerUnavailable) {
    //         return ResponseApi::error($exception->getMessage(), 422);
    //     }else if ($exception instanceof NotFoundHttpException) {
    //         return ResponseApi::error("Not Found", 404);
    //     }else{
    //         return ResponseApi::serverError();
    //     }

    //     return parent::render($request, $exception);
    // }
}

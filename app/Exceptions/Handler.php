<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];
    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param \Exception $exception
     * @return void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($request->wantsJson() && !($exception instanceof \Illuminate\Validation\ValidationException) ) {
            $code = empty($exception->getCode()) ? Response::HTTP_BAD_REQUEST : $exception->getCode();
            $message = $exception->getMessage();
            if ($exception instanceof ModelNotFoundException || $exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
                $code = Response::HTTP_NOT_FOUND;
                $message = 'Resource not found';
            }
            if ($exception instanceof \Symfony\Component\Debug\Exception\FatalThrowableError) {
                $message = "Please check requested endpoint and its parameters";
            }
            return response()->json([
                'error' => [
                    'message' => $message,
                ]
            ], $code);
        }
        return parent::render($request, $exception);
    }
}

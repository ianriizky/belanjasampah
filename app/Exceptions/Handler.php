<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * {@inheritDoc}
     */
    protected $dontReport = [
        //
    ];

    /**
     * {@inheritDoc}
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * {@inheritDoc}
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}

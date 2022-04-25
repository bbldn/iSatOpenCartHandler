<?php

namespace App\Exceptions;

use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * @var string[]
     *
     * @psalm-return list<class-string>
     */
    protected $dontReport = [
        HttpException::class,
        ValidationException::class,
        AuthorizationException::class,
        ModelNotFoundException::class,
    ];
}
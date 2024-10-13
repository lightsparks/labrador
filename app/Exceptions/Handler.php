<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Inertia\Inertia;
use Throwable;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $e)
    {
        if ($e instanceof ModelNotFoundException && $request->wantsJson()) {
            return Inertia::render('Items/ItemNotFound', [
                'message' => 'The item you are looking for could not be found.',
            ])->toResponse($request)->setStatusCode(404);
        }

        return parent::render($request, $e);
    }
}

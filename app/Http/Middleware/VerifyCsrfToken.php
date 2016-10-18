<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [

    'v1/gradebooks/*',  #TODO Remove this, only added for testing purposes
    'v1/gradebooks',
    'v1/checkpoints/*',
    'v1/scores/*',
    ];
}

<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class EncryptCookies extends Middleware
{
    protected static $serialize = true;

    public static function serialized($name)
    {
        return $name !== 'XSRF-TOKEN';
    }

    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array
     */
    protected $except = [
        '/api/*'
    ];
}

<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        '/pages/add/uploadImage',
        '/pages/edit/*/editImage',

        '/memberships/add/uploadImage',
        '/memberships/edit/*/editImage',

        '/sliders/add/uploadImage',
        '/sliders/edit/*/editImage',

        '/projects/add/uploadImage',
        '/projects/edit/*/editImage',

        '/blogs/add/uploadImage',
        '/blogs/edit/*/editImage',

        '/panelSettings/editImage/*/',

        '/users/add/uploadImage',
        '/users/edit/*/editImage',

    ];
}

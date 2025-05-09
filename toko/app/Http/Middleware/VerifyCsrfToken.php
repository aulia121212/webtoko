<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        // Tambahkan route atau URI yang ingin dikecualikan dari CSRF verification di sini
        'api/*', // Nonaktifkan CSRF untuk semua route di bawah prefix 'api'
        'login', // Nonaktifkan CSRF untuk route login
        'register', // Nonaktifkan CSRF untuk route registrasi
        'logout', // Nonaktifkan CSRF untuk route logout
    ];
}
<?php

namespace Config;

use CodeIgniter\Config\Filters as BaseFilters;
use App\Filters\Cors; 
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\ForceHTTPS;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\PageCache;
use CodeIgniter\Filters\PerformanceMetrics;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseFilters
{
    /**
     * Configures aliases for Filter classes.
     */
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'cors'          => Cors::class, 
        'forcehttps'    => ForceHTTPS::class,
        'pagecache'     => PageCache::class,
        'performance'   => PerformanceMetrics::class,
        'auth'          => \App\Filters\Auth::class,
    ];

    /**
     * List of filter aliases that are always applied 
     * before and after every request.
     */
    public array $globals = [
        'before' => [
            'cors', // Wajib di urutan pertama untuk menangkap request OPTIONS
        ],
        'after' => [
            'cors', 
            'toolbar',
        ],
    ];

    /**
     * List of filter aliases that work on a particular HTTP method.
     */
    public array $methods = [
        'options' => ['cors'], // Memastikan method OPTIONS ditangani oleh filter CORS
    ];

    /**
     * List of filter aliases for URI patterns.
     */
    public array $filters = [];
}
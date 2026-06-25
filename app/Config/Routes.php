<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ======================
// 1. ROUTE ARTIKEL PUBLIK (DITARUH DI ATAS AGAR DIPRIORITASIKAN)
// ======================
$routes->get('artikel', 'Artikel::index');
$routes->get('artikel/(:any)', 'Artikel::view/$1');


// ======================
// 2. ROUTE UTAMA & HALAMAN STATIS
// ======================
$routes->get('/', 'Home::index');
$routes->get('about', 'Page::about');
$routes->get('contact', 'Page::contact');
$routes->get('faqs', 'Page::faqs');


// ======================
// 3. ROUTE LOGIN & LOGOUT (USER WEB MVC BLESSED)
// ======================
$routes->get('user/login', 'User::login');
$routes->post('user/login', 'User::login');
$routes->get('user/logout', 'User::logout');


// ======================
// 4. ROUTE API AUTENTIKASI (TAMBAHAN UTAMA UNTUK MODUL 13 VueJS)
// ======================
/**
 * Endpoint ini digunakan oleh Axios di frontend VueJS untuk proses login.
 * Mengarah ke Api\Auth Controller dengan method login.
 */
$routes->post('api/login', 'Api\Auth::login');
$routes->post('api/auth/login', 'Api\Auth::login'); // Ditambahkan agar sinkron dengan Axios frontend


// ======================
// 5. ROUTE AJAX (MODUL 8 & 9)
// ======================
$routes->get('ajax', 'AjaxController::index');       
$routes->get('ajax/getData', 'AjaxController::getData'); 
$routes->delete('ajax/delete/(:num)', 'AjaxController::delete/$1'); 


// ======================
// 6. ROUTE REST API (MODUL 10)
// ======================
$routes->resource('post', ['controller' => 'Post']);


// ======================
// 7. ROUTE ADMIN (DENGAN FILTER AUTH BROWSER)
// ======================
$routes->group('admin', ['filter' => 'auth'], function($routes) {
    $routes->get('artikel', 'Artikel::admin_index');
    $routes->get('artikel/add', 'Artikel::add');
    $routes->post('artikel/add', 'Artikel::add');
    $routes->get('artikel/edit/(:num)', 'Artikel::edit/$1');
    $routes->post('artikel/edit/(:num)', 'Artikel::edit/$1');
    $routes->get('artikel/delete/(:num)', 'Artikel::delete/$1');
});
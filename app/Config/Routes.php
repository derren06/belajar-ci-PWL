<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// halaman utama (harus login)
$routes->get('/', 'Home::index', ['filter' => 'auth']);

// login & logout
$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::login');
$routes->get('logout', 'AuthController::logout');

//  HALAMAN PROFILE 
$routes->get('profile', 'ProfileController::index', ['filter' => 'auth']);  

// halaman lain 
$routes->get('produk', 'ProdukController::index', ['filter' => 'auth']);
$routes->get('keranjang', 'TransaksiController::index', ['filter' => 'auth']);
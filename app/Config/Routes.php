<?php

use CodeIgniter\Commands\Utilities\Routes;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');


// Login
$routes->get('/login', 'login::index');
$routes->post('/loginProcess', 'login::loginProcess');
$routes->get('/logout', 'login::logout');

// profil
$routes->get('/profil', 'ProfilController::show');
$routes->post('/profil', 'profilController::index');
$routes->post('/profil/saveData/(:num)', 'profilController::save/$1');


// Admin
$routes->group('admin',['filter' => 'admin'], function($routes) {
    $routes->get('/', 'adminController::index');
    $routes->get('create', 'adminController::create');
    $routes->post('store', 'adminController::store');
    $routes->delete('(:num)', 'adminController::delete/$1');
    $routes->get('edit/(:segment)', 'adminController::edit/$1');
    $routes->post('update/(:any)', 'adminController::update/$1');

    // Router Peminjaman Di admin
    $routes->get('peminjaman', 'AdminPinjamController::index');
    $routes->post('peminjaman/signature', 'AdminPinjamController::signature');
    $routes->post('peminjaman/tolak', 'AdminPinjamController::tolak');
    $routes->get('peminjaman/riwayat', 'AdminPinjamController::riwayat');
    $routes->post('peminjaman/(:num)', 'AdminPinjamController::reset/$1');

    // Route Pengembalian di Admin
    $routes->get('pengembalian', 'AdminPengembalianController::index');
    $routes->post('pengembalian/(:num)', 'AdminPengembalianController::sudahKembali/$1');
    $routes->get('pengembalian/sudah', 'AdminPengembalianController::sudah');
    $routes->get('pengembalian/belum', 'AdminPengembalianController::belum');
    $routes->post('pengembalian/paksa/(:num)', 'AdminPengembalianController::paksa/$1');
    

    // Tambah Stok
    $routes->get('stok', 'AdminStokController::index');
    $routes->post('stok', 'AdminStokController::index');
    $routes->post('stok/tambah/(:any)', 'AdminStokController::tambah/$1');
    $routes->post('stok/kurangi/(:any)', 'AdminStokController::kurangi/$1');


});



// Home
$routes->group('/', ['filter' => 'user'], function($routes){
    $routes->get('', 'Home::index');
    $routes->get('/detail/(:any)', 'Home::detail/$1');
    $routes->post('/rating/(:any)', 'Home::rating/$1');

    $routes->post('/favorit/(:num)', 'FavoritController::tambahFavorit/$1');
    $routes->delete('/favorit/hapus/(:num)', 'FavoritController::hapusFavorit/$1');

    // fitur pencarian
    // $routes->get('/search', 'SearchController::index');
    $routes->get('search', 'SearchController::index');
    







    $routes->get('/kategori/(:any)', 'kategoriController::kategori/$1');


    //Route Peminjaman Di Halaman User
    $routes->get('/pinjam/(:any)', 'pinjamController::index/$1');
    $routes->post('/pinjam/proses/(:any)', 'pinjamController::proses/$1');

});

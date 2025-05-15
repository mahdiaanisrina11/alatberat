<?php

use App\Controllers\AlatBeratController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Hello::index');
$routes->get('/', 'Home::index');
$routes->get('alatberat/lihat', 'Home::index');

$routes->get('/login', 'Auth::login');
$routes->post('/ceklogin', 'Auth::cekLogin');
$routes->get('/logout', 'Auth::logout');

$routes->get('/register', 'Auth::register');
$routes->post('/registerdata', 'Auth::registerdata');

$routes->get('alatberat/lihat_alat', 'AlatBeratController::lihatAlatBerat');

$routes->get('/alatberat', 'AlatBeratController::index');
$routes->get('/alatberat/create', 'AlatBeratController::create'); 
$routes->post('/alatberat/store', 'AlatBeratController::store'); 
$routes->get('/alatberat/edit/(:num)', 'AlatBeratController::edit/$1');
$routes->post('/alatberat/update/(:num)', 'AlatBeratController::update/$1');
$routes->get('/alatberat/delete/(:num)', 'AlatBeratController::delete/$1');
$routes->get('/alatberat/show/(:num)', 'AlatBeratController::show/$1');
$routes->post('/alatberat/(:num)/stok', 'AlatBeratController::stok/$1');
$routes->post('/alatberat/(:num)/stok/update-delete', 'AlatBeratController::updateDeleteStok/$1');
$routes->get('/alatberat/detail/(:num)', 'AlatBeratController::detail/$1');

$routes->get('pesanan/daftar', 'AlatBeratController::daftar');
$routes->post('pesanan/update_status', 'AlatBeratController::updateStatus');

$routes->get('pesanan/daftar-user', 'PesananController::daftarUser');
$routes->get('pesanan/history-user', 'PesananController::historyUser');
$routes->post('pesanan/batal/(:num)', 'PesananController::batal/$1');

$routes->get('/pesanan', 'PesananController::index');
$routes->post('/pesanan/cek', 'PesananController::cekKetersediaan');
$routes->get('/pesanan/form/(:num)', 'PesananController::form/$1');
$routes->post('/pesanan/checkout', 'PesananController::checkout');
$routes->post('/pesanan/final', 'PesananController::finalize');
$routes->get('/pesanan/pembayaran/(:num)', 'PesananController::pembayaran/$1');
$routes->post('pesanan/upload_bukti', 'PesananController::upload_bukti');

$routes->get('/keranjang', 'PesananController::keranjang');
$routes->get('/keranjang/hapus/(:num)', 'PesananController::hapusKeranjang/$1');
$routes->post('/keranjang/selesaikan', 'PesananController::selesaikanPesanan');
$routes->get('/pesanan/pembayaran-keranjang', 'PesananController::pembayaranKeranjang');


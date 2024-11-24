<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/produk', 'ProdukController::index');
$routes->get('/produk/tampil', 'ProdukController::tampil');
$routes->post('/produk/tambah', 'ProdukController::simpan');
$routes->post('/produk/hapus', 'ProdukController::hapus');
$routes->post('/produk/edit', 'ProdukController::edit');

// pelanggan
$routes->get('/pelanggan', 'PelangganController::index');
$routes->get('/pelanggan/tampil', 'PelangganController::tampil');
$routes->post('/pelanggan/tambah', 'PelangganController::simpan');
$routes->post('/pelanggan/hapus', 'PelangganController::hapus');
$routes->post('/pelanggan/edit', 'PelangganController::edit');

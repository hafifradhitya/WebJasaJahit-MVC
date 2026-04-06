<?php
  
$router->get('/', 'BerandaController@index');
$router->get('/beranda', 'BerandaController@index');

// Auth Routes
$router->get('/auth/login', 'LoginController@index');
$router->post('/auth/login', 'LoginController@index');
$router->get('/auth/register', 'RegisterController@index');
$router->post('/auth/register', 'RegisterController@index');
$router->get('/auth/logout', 'LogoutController@logout');
$router->get('/auth/logout.php', 'LogoutController@logout');

// Admin Routes
$router->get('/admin/dashboard/dashboard', 'DashboardController@index');
$router->get('/admin/dashboard', 'DashboardController@index');

// Data Pelanggan Routes
$router->get('/admin/data_pelanggan/pelanggan', 'UserController@index');
$router->get('/admin/data_pelanggan/tambah', 'UserController@tambah');
$router->post('/admin/data_pelanggan/tambah', 'UserController@tambah');
$router->get('/admin/data_pelanggan/edit', 'UserController@edit');
$router->post('/admin/data_pelanggan/edit', 'UserController@edit');
$router->get('/admin/data_pelanggan/detail', 'UserController@detail');
$router->get('/admin/data_pelanggan/hapus', 'UserController@hapus');
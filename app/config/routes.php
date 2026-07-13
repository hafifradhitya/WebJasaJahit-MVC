<?php
  
$router->get('/', 'BerandaController@index');
$router->get('/beranda', 'BerandaController@index');
$router->get('/front/beranda.php', 'BerandaController@index');
$router->get('/detail_layanan.php', 'BerandaController@detail_layanan');
$router->get('/front/detail_layanan.php', 'BerandaController@detail_layanan');
$router->get('/detail_layanan', 'BerandaController@detail_layanan');
$router->post('/beranda/send_email', 'BerandaController@sendEmail');

// Checkout Route (Website Order)
$router->post('/checkout/process', 'CheckoutController@process');

// Auth Routes
$router->get('/auth/register', 'RegisterController@index');
$router->post('/auth/register', 'RegisterController@register');
$router->get('/auth/logout', 'LogoutController@logout');

// Chatbot Route
$router->post('/chatbot/reply', 'ChatbotController@reply');

// Tracking Routes
$router->get('/lacak', 'TrackingController@index');
$router->post('/lacak/search', 'TrackingController@search');
$router->get('/auth/logout.php', 'LogoutController@logout');

// Payment Routes
$router->post('/payment/token', 'PaymentController@token');
$router->post('/payment/webhook', 'PaymentController@webhook');
$router->get('/payment/success', 'PaymentController@success');

// Admin Secret Login entry point
$router->get('/dashboard/portal-admin-webjasajahit', 'LoginController@generateToken');

// Dynamic random char route for Admin Login
if (isset($_SESSION['admin_login_token'])) {
    $token = $_SESSION['admin_login_token'];
    $router->get('/' . $token, 'LoginController@index');
    $router->post('/' . $token, 'LoginController@login');
}

// Admin Routes
$router->get('/admin/dashboard/dashboard', 'DashboardController@index');
$router->get('/admin/dashboard', 'DashboardController@index');
$router->post('/admin/dashboard/chart_data', 'DashboardController@chartData');
$router->get('/admin/search', 'SearchController@index');
$router->get('/admin/profile', 'ProfileController@index');
$router->post('/admin/profile', 'ProfileController@index');
$router->get('/admin/profile.php', 'ProfileController@index');
$router->post('/admin/profile.php', 'ProfileController@index');
$router->get('/admin/profile/ubah_password', 'ProfileController@ubahPassword');
$router->post('/admin/profile/ubah_password', 'ProfileController@ubahPassword');
$router->get('/admin/fitur_lainnya/ubah_password.php', 'ProfileController@ubahPassword');
$router->post('/admin/fitur_lainnya/ubah_password.php', 'ProfileController@ubahPassword');

// Data Pelanggan Routes
$router->get('/admin/data_pelanggan/pelanggan', 'UserController@index');
$router->get('/admin/data_pelanggan/tambah', 'UserController@tambah');
$router->post('/admin/data_pelanggan/tambah', 'UserController@tambah');
$router->get('/admin/data_pelanggan/edit', 'UserController@edit');
$router->post('/admin/data_pelanggan/edit', 'UserController@edit');
$router->get('/admin/data_pelanggan/detail', 'UserController@detail');
$router->get('/admin/data_pelanggan/hapus', 'UserController@hapus');


$router->get('/admin/data_kategori/kategori', 'KategoriController@index');
$router->get('/admin/data_kategori/tambah', 'KategoriController@tambah');
$router->post('/admin/data_kategori/tambah', 'KategoriController@tambah');
$router->get('/admin/data_kategori/edit', 'KategoriController@edit');
$router->post('/admin/data_kategori/edit', 'KategoriController@edit');
$router->get('/admin/data_kategori/detail', 'KategoriController@detail');
$router->get('/admin/data_kategori/hapus', 'KategoriController@hapus');

$router->get('/admin/data_layanan/layanan', 'LayananController@index');
$router->get('/admin/data_layanan/tambah', 'LayananController@tambah');
$router->post('/admin/data_layanan/tambah', 'LayananController@tambah');
$router->get('/admin/data_layanan/edit', 'LayananController@edit');
$router->post('/admin/data_layanan/edit', 'LayananController@edit');
$router->get('/admin/data_layanan/detail', 'LayananController@detail');
$router->get('/admin/data_layanan/hapus', 'LayananController@hapus');

// Data Pesanan Routes
$router->get('/admin/data_pesanan/semuapesanan', 'PesananController@index');
$router->get('/admin/data_pesanan/tambah', 'PesananController@tambah');
$router->post('/admin/data_pesanan/tambah', 'PesananController@tambah');
$router->get('/admin/data_pesanan/edit', 'PesananController@edit');
$router->post('/admin/data_pesanan/edit', 'PesananController@edit');
$router->get('/admin/data_pesanan/detail', 'PesananController@detail');
$router->get('/admin/data_pesanan/hapus', 'PesananController@hapus');
$router->post('/admin/data_pesanan/update_status', 'PesananController@updateStatus');
$router->get('/admin/data_pesanan/pesananmenunggu', 'PesananController@pesananmenunggu');
$router->get('/admin/data_pesanan/pesanandiproses', 'PesananController@pesanandiproses');
$router->get('/admin/data_pesanan/pesananselesaidiambil', 'PesananController@pesananselesaidiambil');

// Data Laporan Routes
$router->get('/admin/data_laporan/laporan', 'LaporanController@index');
$router->post('/admin/data_laporan/rekap_data_excel.php', 'LaporanController@rekapExcel');
$router->post('/admin/data_laporan/rekap_data_excel', 'LaporanController@rekapExcel');
$router->post('/admin/data_laporan/rekap_excel.php', 'LaporanController@rekapExcel');
$router->post('/admin/data_laporan/rekap_excel', 'LaporanController@rekapExcel');

?>
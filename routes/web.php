<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'FrontController@index');

// Frontend
Route::get('pencarian-laundry','FrontController@search');

Auth::routes([
    'register' => false,
]);

Route::middleware('auth')->group(function () {
  Route::get('/home', 'HomeController@index')->name('home');

  // Modul Admin
  Route::prefix('/')->middleware('role:Admin')->group(function () {
    Route::resource('admin','Admin\AdminController');
    // Pengguna
    Route::get('adm','Admin\AdminController@adm');
    Route::get('kry','Admin\AdminController@kry');
    Route::get('kry-add','Admin\AdminController@addkry');

    // Customer
    Route::get('customer','Admin\AdminController@customer');
    Route::get('customer-add','Admin\AdminController@addcustomer');
    Route::post('customer-store','Admin\AdminController@storecustomer');
    Route::get('customer-edit/{id_customer}','Admin\AdminController@editcustomer');
    Route::put('customer-update/{id_customer}','Admin\AdminController@updatecustomer');
    Route::delete('customer-delete/{id_customer}','Admin\AdminController@deletecustomer');
    Route::get('jml-transaksi','Admin\AdminController@jmlTransaksi');

    // Data Laundri
    Route::get('data-transaksi','Admin\AdminController@datatransaksi');
    Route::get('data-harga','Admin\AdminController@dataharga');
    Route::post('harga-store','Admin\AdminController@hargastore');
    Route::get('edit-harga','Admin\AdminController@hargaedit');

    // Laporan
    Route::get('invoice-customer/{id}','Admin\AdminController@invoice');

    // Finance
    Route::get('data-finance','Admin\AdminController@finance');

    // Notifikasi
    Route::get('read-notification','Admin\AdminController@notif');

    // Filter
    Route::get('filter-transaksi','Admin\AdminController@filtertransaksi');

    // Setting
    Route::get('settings','Admin\SettingsController@setting');
    Route::put('proses-setting-page/{id}','Admin\SettingsController@proses_set_page')->name('seting-page.update');
    Route::put('set-theme-email/{id}','Admin\SettingsController@set_theme_email')->name('setting-theme-email.update');
    Route::put('set-target-laundry/{id}','Admin\SettingsController@set_target_laundry')->name('set-target.update');
    Route::post('add-bank','Admin\SettingsController@bank')->name('setting.bank');

    // Profile
    Route::get('profile-admin/{id}','Admin\AdminController@profile');
    Route::get('profile-admin-edit','Admin\AdminController@edit_profile');
  });

  // Modul Karyawan
  Route::prefix('/')->middleware('role:Karyawan')->group(function () {
    Route::resource('pelayanan','Karyawan\PelayananController');
    // Transaksi
    Route::get('add-order','Karyawan\PelayananController@addorders');
    Route::get('ubah-status-order','Karyawan\PelayananController@ubahstatusorder');
    Route::get('ubah-status-bayar','Karyawan\PelayananController@ubahstatusbayar');
    Route::get('ubah-status-ambil','Karyawan\PelayananController@ubahstatusambil');

    // Customer
    Route::get('list-customer','Karyawan\PelayananController@listcs');
    Route::get('list-customer-add','Karyawan\PelayananController@listcsadd');
    Route::post('list-costomer-store','Karyawan\PelayananController@addcs');

    // Filter
    Route::get('listharga','Karyawan\PelayananController@listharga');
    Route::get('listhari','Karyawan\PelayananController@listhari');

    // Laporan
    Route::get('invoice-kar/{id}','Karyawan\PelayananController@invoicekar');
    Route::get('cetak-invoice/{id}/print','Karyawan\PelayananController@cetakinvoice');

    // Profile
    Route::get('profile-karyawan/{id}','Karyawan\ProfileController@karyawanProfile');
    Route::get('profile-karyawan/edit/{id}','Karyawan\ProfileController@karyawanProfileEdit');
    Route::put('profile-karyawan/update/{id}','Karyawan\ProfileController@karyawanProfileSave');
    Route::get('reset-password','Karyawan\ProfileController@reset_password');

    // Setting
    Route::get('karyawan/setting','Karyawan\SettingsController@setting');
    Route::put('proses-setting-karyawan/{id}','Karyawan\SettingsController@proses_setting_karyawan')->name('proses-setting-karyawan.update');
  });
});

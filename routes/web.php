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

Auth::routes();
// Auth modification
Route::get('register', 'Auth\RegisterController@registerOption')->name('register');
Route::get('register/koperasi', 'Auth\RegisterController@getRegisterKoperasi');
Route::post('register/koperasi', 'Auth\RegisterController@postRegisterKoperasi')->name('register.koperasi');
Route::get('register/bank', 'Auth\RegisterController@getRegisterBank');
Route::post('register/bank', 'Auth\RegisterController@postRegisterBank')->name('register.bank');
Route::get('verify', 'Auth\RegisterController@verify')->name('signup.verify');

// HomeController
Route::group(['middleware' => 'checkuser'], function () {
    // Beranda
    Route::get('/', 'HomeController@index')->middleware(['checkuser']);
    // Kategori
    Route::get('/produk', 'HomeController@categoryIndex')->middleware(['checkuser']);
    Route::get('/produk/kategori/{kategori}', 'HomeController@categoryShow')->middleware(['checkuser']);
    // Produk
    Route::get('/produk/{good}', 'HomeController@product')->middleware(['checkuser']);
    Route::post('/produk/{good}', 'HomeController@transaction')->middleware(['checkuser']);
    // Tentang
    Route::get('/tentang', 'HomeController@about')->middleware(['checkuser']);
    // Kontak
    Route::get('/kontak', 'HomeController@contact')->middleware(['checkuser']);
    // transaksi
    Route::post('/transaksi/proses', 'HomeController@storeReceipt')->middleware(['checkuser']);
    // cetak laporan
    Route::get('koperasi/transaksi/cetak', 'ReceiptController@cetak')->middleware('role:admin_koperasi');
});

// masuk ke dashboard (VueJS magic)
Route::group(['middleware' => 'checkuser'], function () {
    Route::get('sistem', 'AdminController@sistem')->middleware('role:admin_sistem');
    Route::get('koperasi', 'AdminController@koperasi')->middleware('role:admin_koperasi');
    Route::get('bank', 'AdminController@bank')->middleware('role:admin_bank');
    Route::get('nasabah', 'AdminController@nasabah')->middleware('role:nasabah');
});

// Rest API
Route::group([    
    'middleware' => 'checkuser',
    'prefix'     => 'api'
    ], function () {
    // profil
    Route::put('profil/{user}/profil', 'UserController@updateProfil')->middleware('role:admin_sistem|admin_koperasi|admin_bank|nasabah');
    Route::put('profil/{user}/password', 'UserController@updatePassword')->middleware('role:admin_sistem|admin_koperasi|admin_bank|nasabah');
    Route::get('profil', 'UserController@profil')->middleware('role:admin_sistem|admin_koperasi|admin_bank|nasabah');

    // adminSistem
    Route::group([
        'middleware' => 'role:admin_sistem',
        'prefix' => 'sistem'
        ], function () {
            // lain-lain
            Route::get('user/getIDForKoperasi', 'UserController@getIDForKoperasi');
            Route::get('user/getIDForBank', 'UserController@getIDForBank');

            // master-peran
            Route::resource('peran', 'RoleController', ['except' => [
                // 'index', 'show', 'update'
                'create', 'store', 'edit', 'destroy'
            ]]);
            
            // master-kategori-barang
            Route::get('kategori/getLastID', 'CategoryController@getLastID');
            Route::resource('kategori', 'CategoryController', ['except' => [
                // 'index', 'store', 'show', 'update', 'destroy'
                'create', 'edit'
            ]]);

            // master-kode-transaksi
            Route::get('kode/getLastID', 'CodeController@getLastID');
            Route::resource('kode', 'CodeController', ['except' => [
                // 'index', 'store', 'show', 'update', 'destroy'
                'create', 'edit'
            ]]);

            // aktivasi-koperasi
            Route::get('koperasi/getLastID', 'KoperasiController@getLastID');
            Route::post('koperasi/{koperasi}/activate', 'KoperasiController@activate');
            Route::post('koperasi/{koperasi}/deactivate', 'KoperasiController@deactivate');
            Route::resource('koperasi', 'KoperasiController', ['except' => [
                // 'index', 'store', 'show', 'update', 'destroy'
                'create', 'edit'
            ]]);            

            // aktivasi-bank
            Route::get('bank/getLastID', 'BankController@getLastID');
            Route::post('bank/{bank}/activate', 'BankController@activate');
            Route::post('bank/{bank}/deactivate', 'BankController@deactivate'); 
            Route::resource('bank', 'BankController', ['except' => [
                // 'index', 'store', 'show', 'update', 'destroy'
                'create', 'edit'
            ]]);

            // daftaruser
            Route::post('user/{user}/activate', 'UserController@activate');
            Route::post('user/{user}/deactivate', 'UserController@deactivate');
            Route::post('user/{user}/reset', 'UserController@reset');
            Route::resource('user', 'UserController', ['except' => [
                // 'index', 'store', 'show', 'update', 'destroy'
                'create', 'edit'
            ]]);
    });

    // adminKoperasi
    Route::group([
        'middleware' => 'role:admin_koperasi',
        'prefix' => 'koperasi'
        ], function () {
            // mendapatkan Koperasi ID dari admin koperasi yang login
            Route::get('getKoperasiID', 'KoperasiController@getKoperasiID');
            // mendapatkan User ID dari user yang login
            Route::get('getUserID', 'UserController@getUserID');
            // mendapatkan daftar barang untuk stok
            Route::get('barang/get', 'GoodController@get');

            // my
            Route::get('my', 'KoperasiController@getAuthKoperasi');
            Route::put('my/{bank}', 'KoperasiController@update');

            // master-kategoribarang
            Route::get('kategori', 'CategoryController@index');

            // master-barang
            Route::post('barang/{good}/activate', 'GoodController@activate');
            Route::post('barang/{good}/deactivate', 'GoodController@deactivate');
            Route::get('barang/getLastID', 'GoodController@getLastID');
            Route::get('barang/prioritas', 'GoodController@gePriorityStatus');
            Route::get('kategori/get', 'CategoryController@get');
            Route::resource('barang', 'GoodController', ['except' => [
                // 'index', 'show', 'update', 'store', 'destroy'
                'create', 'edit'
            ]]);

            // stok
            Route::get('stok/getLastID', 'StockController@getLastID');
            Route::resource('stok', 'StockController', ['except' => [
                // 'index', 'show', 'store', 'destroy'
                'create', 'edit', 'update'
            ]]);

            // transaksibelanja
            Route::post('transaksi/{receipt}/activate', 'ReceiptController@activate');
            Route::post('transaksi/{receipt}/deactivate', 'ReceiptController@deactivate');
            Route::resource('transaksi', 'ReceiptController', ['except' => [
                // 'index', 'show', 'store', 'destroy'
                'create', 'edit', 'update'
            ]]);
    });

    // adminBank
    Route::group([
        'middleware' => 'role:admin_bank',
        'prefix' => 'bank'
        ], function () {
            // mendapatkan Bank ID dari admin bank yang login
            Route::get('getBankID', 'BankController@getBankID');
            // mendapatkan daftar nasabah untuk transaksi
            Route::get('nasabah/get', 'CustomerController@get');

            // my
            Route::get('my', 'BankController@getAuthBank');
            Route::put('my/{bank}', 'BankController@update');

            // master-kodetransaksi
            Route::get('kode', 'CodeController@index');

            // master-nasabah
            Route::post('nasabah/{user}/activate', 'CustomerController@activate');
            Route::post('nasabah/{user}/deactivate', 'CustomerController@deactivate');
            Route::post('nasabah/{user}/reset', 'CustomerController@reset');
            Route::get('nasabah/getLastID', 'CustomerController@getLastID');
            Route::resource('nasabah', 'CustomerController', ['except' => [
                // 'index', 'show', 'update', 'store', 'destroy'
                'create', 'edit'
            ]]);

            // transaksi
            Route::get('transaksi/getLastID', 'TransactionController@getLastID');
            Route::get('kode/getSetoran', 'CodeController@getSetoran');
            Route::get('kode/getPenarikan', 'CodeController@getPenarikan');
            Route::resource('transaksi', 'TransactionController', ['except' => [
                // 'index', 'show', 'store', 'destroy'
                'create', 'edit', 'update'
            ]]);
    });

    // nasabah
    Route::group([
        'middleware' => 'role:nasabah',
        'prefix' => 'nasabah'
        ], function () {
            // mendapatkan saldo nasabah
            Route::get('saldo', 'CustomerController@getBalance');

            
            
            Route::resource('transaksi', 'ReceiptController', ['except' => [
                // 'index', 'show', 'store', 'destroy'
                'create', 'edit', 'update'
            ]]);
            // mendapatkan riwayat transaksi
            Route::get('transaksi', 'TransactionController@getHistory');
    });
});
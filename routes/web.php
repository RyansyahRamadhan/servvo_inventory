<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\RakController;
use App\Http\Controllers\SubRakController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\LorongController;
use App\Http\Controllers\FormulaController;
use App\Http\Controllers\AjaxBarangController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\Master\StandartPalletController;
use App\Http\Controllers\Input\BarangMasukController;
use App\Http\Controllers\Input\FpbController;
use App\Http\Controllers\Input\LpbhpController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\Input\MoveRakController;
use App\Http\Controllers\Laporan\BarangPerLorongController;
use App\Http\Controllers\Laporan\StokPerLorongController;
use App\Http\Controllers\Input\StockAdjustmentController;
use App\Http\Controllers\Input\BarangKeluarController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');   
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// CRUD Barang Routes
Route::resource('barang', BarangController::class);
Route::get('/daftar/barang', [BarangController::class, 'index'])->name('barang.index');
Route::get('daftar/barang/{kode_barang}/edit', [BarangController::class, 'edit'])->name('barang.edit');
Route::put('daftar/barang/{kode_barang}', [BarangController::class, 'update'])->name('barang.update');
Route::delete('daftar/barang/{kode_barang}', [BarangController::class, 'destroy'])->name('barang.destroy');
Route::get('daftar/daftar/barang/exportexcelbarang', [BarangController::class, 'export'])->name('barang.export');
Route::post('/daftar/barang/importexcelbarang', [BarangController::class, 'import'])->name('barang.import');

//login
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

//rak
Route::prefix('daftar/rak')->name('rak.')->group(function () {
Route::get('/', [RakController::class, 'index'])->name('index');
Route::get('/create', [RakController::class, 'create'])->name('create');
Route::post('/', [RakController::class, 'store'])->name('store');
Route::get('/get-lorong-by-gudang', [RakController::class, 'getLorongByGudang']);
Route::get('/{id_rak}/edit', [RakController::class, 'edit'])->name('edit');
Route::get('/export', [RakController::class, 'export'])->name('export');
Route::post('/import', [RakController::class, 'import'])->name('import');
Route::delete('/{id_rak}', [RakController::class, 'destroy'])->name('destroy');
Route::put('/{id_rak}', [RakController::class, 'update'])->name('update');
});
Route::prefix('daftar/subrak')->name('subrak.')->group(function () {
Route::get('/', [SubRakController::class, 'index'])->name('index');
Route::resource('subrak', SubRakController::class)->only(['store', 'destroy']);
Route::get('/create', [SubRakController::class, 'create'])->name('create');
Route::post('/', [SubRakController::class, 'store'])->name('store');
});

//gudang
Route::prefix('daftar/gudang')->name('gudang.')->group(function () {
Route::get('/', [GudangController::class, 'index'])->name('index');
 Route::post('/', [GudangController::class, 'store'])->name('store');
Route::get('/create', [GudangController::class, 'create'])->name('create');
 Route::get('/{id_gudang}/edit', [GudangController::class, 'edit'])->name('edit');
 Route::put('/{id_gudang}', [GudangController::class, 'update'])->name('update');
Route::delete('/{id_gudang}', [GudangController::class, 'destroy'])->name('destroy');

});
//lorong
Route::resource('lorong', LorongController::class);
Route::get('daftar/lorong', [LorongController::class, 'index'])->name('lorong.index');
Route::get('daftar/lorong/create', [LorongController::class, 'create'])->name('lorong.create');
Route::post('daftar/lorong', [LorongController::class, 'store'])->name('lorong.store');
Route::get('daftar/lorong/export', [LorongController::class, 'export'])->name('lorong.export');
Route::get('daftar/lorong/{id_lorong}/edit', [LorongController::class, 'edit'])->name('lorong.edit');
Route::put('daftar/lorong/{id_lorong}', [LorongController::class, 'update'])->name('lorong.update'); // ✅ ditambahkan
Route::delete('daftar/lorong/{id_lorong}', [LorongController::class, 'destroy'])->name('lorong.destroy'); // ✅ diperbaiki
Route::post('daftar/lorong/import', [LorongController::class, 'import'])->name('lorong.import');


//formula
Route::resource('formula', FormulaController::class);
Route::get('/daftar/formula', [FormulaController::class, 'index'])->name('formula.index');
Route::post('daftar/formula/import', [FormulaController::class, 'import'])->name('formula.import');
Route::get('daftar/formula/export', [FormulaController::class, 'export'])->name('formula.export');
Route::get('daftar/formula/create', [FormulaController::class, 'create'])->name('formula.create');
Route::post('daftar/formula/store', [FormulaController::class, 'store'])->name('formula.store');
Route::get('daftar/formula/{id}/edit', [FormulaController::class, 'edit'])->name('formula.edit');
Route::put('daftar/formula/{id}', [FormulaController::class, 'update'])->name('formula.update');
Route::get('daftar/formula/{kode_formula}', [FormulaController::class, 'show'])->name('formula.show');
Route::delete('daftar/formula/{kode_formula}', [FormulaController::class, 'destroy'])->name('formula.destroy');


//stok
Route::prefix('daftar')->name('stok.')->group(function () {
    Route::get('/stok', [StokController::class, 'index'])->name('index');
    Route::get('/stok/{kode_barang}/detail', [StokController::class, 'detail'])->name('detail');
    Route::get('/stok/{kode_barang}/rak', [StokController::class, 'rak'])->name('rak');
});


// Route untuk AJAX
Route::get('/ajax/get-nama-formula', [AjaxBarangController::class, 'getNamaFormula'])->name('get.nama_formula');
Route::get('/ajax/get-nama-barang', [AjaxBarangController::class, 'getNamaBarang'])->name('get.nama_barang');
Route::get('/ajax/get-barang', [FormulaController::class, 'getBarangByFormula']);
Route::get('/ajax/get-barang', [StandartPalletController::class, 'getBarangByFormula']);
Route::get('/get-lorong-by-gudang', [RakController::class, 'getLorongByGudang']);
Route::get('/ajax/get-nama-barang-kategori', [AjaxController::class, 'getNamaBarangKategori']);
Route::get('/barangmasuk/fetch-data/{kode_barang}', [BarangMasukController::class, 'fetchData']);
Route::get('/barangmasuk/get-rak/{nama_lorong}', [BarangMasukController::class, 'getRakKosong']);



//master
Route::prefix('master/standartpallet')->name('standartpallet.')->group(function () {
    Route::get('/', [StandartPalletController::class, 'index'])->name('index');
    Route::get('/create', [StandartPalletController::class, 'create'])->name('create');
    Route::post('/', [StandartPalletController::class, 'store'])->name('store');
    Route::get('/{kode_barang}/edit', [StandartPalletController::class, 'edit'])->name('edit');
    Route::put('/{kode_barang}', [StandartPalletController::class, 'update'])->name('update');
    Route::delete('/{kode_barang}', [StandartPalletController::class, 'destroy'])->name('destroy');

    // Import & Export
    Route::get('/export', [StandartPalletController::class, 'export'])->name('export');
    Route::post('/import', [StandartPalletController::class, 'import'])->name('import');

});


//input
//barangmasuk
Route::prefix('input/barangmasuk')->name('barangmasuk.')->group(function () {
    Route::get('/', [BarangMasukController::class, 'index'])->name('index');
    Route::get('/create', [BarangMasukController::class, 'create'])->name('create');
    Route::post('/', [BarangMasukController::class, 'store'])->name('store');
    Route::get('/{no_dokumen}/edit', [BarangMasukController::class, 'edit'])->name('edit');
    Route::put('/{no_dokumen}', [BarangMasukController::class, 'update'])->name('update');
    Route::delete('/{no_dokumen}', [BarangMasukController::class, 'destroy'])->name('destroy');

});

//FPB
Route::prefix('fpb')->name('fpb.')->group(function () {
    Route::get('/', [FPBController::class, 'index'])->name('index');
    Route::get('/create', [FPBController::class, 'create'])->name('create');
    Route::post('/', [FPBController::class, 'store'])->name('store');
    Route::get('/{no_fpb}', [FPBController::class, 'show'])->name('show');
    Route::get('/{no_fpb}/edit', [FPBController::class, 'edit'])->name('edit');
    Route::put('/{no_fpb}', [FPBController::class, 'update'])->name('update');
    Route::post('/fpb/rollback-kapasitas', [FPBController::class, 'rollbackKapasitas']);
     Route::delete('/{no_fpb}', [FPBController::class, 'destroy'])->name('destroy');
    // AJAX
    Route::get('/fetch-barang/{kode_formula}', [FPBController::class, 'fetchBarang']);
    Route::get('/fetch-detail/{kode}/{qty}', [FPBController::class, 'fetchDetail']);
    Route::get('/fetch-rak/{nama_barang}/{qty}', [FPBController::class, 'rekomendasiRak']);
});
//LPBHP
Route::prefix('lpbhp')->name('lpbhp.')->group(function () {
    Route::get('/', [LPBHPController::class, 'index'])->name('index');
    Route::get('/create', [LPBHPController::class, 'create'])->name('create');
    Route::post('/', [LPBHPController::class, 'store'])->name('store');

    // AJAX helper
    Route::get('/get-fpb/{no_fpb}', [LPBHPController::class, 'getFpb'])->name('get-fpb');
    Route::get('/get-kapasitas/{kode_barang}', [LPBHPController::class, 'getKapasitas'])->name('get-kapasitas');
    Route::get('/get-lorong-list', [LPBHPController::class, 'getLorongList'])->name('get-lorong-list');
    Route::get('/get-rak-rekomendasi/{kode_barang}/{qty}', [LPBHPController::class, 'getRakRekomendasi'])->name('get-rak-rekomendasi');

    // CRUD detail
    Route::get('/{no_lpbhp}', [LPBHPController::class, 'show'])->name('show');
    Route::get('/{no_lpbhp}/edit', [LPBHPController::class, 'edit'])->name('edit');
    Route::put('/{no_lpbhp}', [LPBHPController::class, 'update'])->name('update');
    Route::delete('/{no_lpbhp}', [LPBHPController::class, 'destroy'])->name('destroy');
});
//moverak


Route::prefix('move-rak')->name('moverak.')->group(function () {
    // pages
    Route::get('/',        [MoveRakController::class, 'index'])->name('index');
    Route::get('/create',  [MoveRakController::class, 'create'])->name('create');
    Route::post('/',       [MoveRakController::class, 'store'])->name('store');
    Route::get('/{id}',    [MoveRakController::class, 'show'])->name('show');

    // ajax for the form
    Route::prefix('api')->name('api.')->group(function () {
        Route::get('/rak/by-lorong', [MoveRakController::class, 'apiRakByLorong']);
        Route::get('/barang',        [MoveRakController::class, 'apiBarang']);
        Route::get('/standar-rak',   [MoveRakController::class, 'apiStandarRak']);
    });
});

//penyesuaian stok

Route::prefix('penyesuaian')->name('penyesuaian.')->group(function () {
    Route::get('/',           [StockAdjustmentController::class, 'index'])->name('index');
    Route::get('/create',     [StockAdjustmentController::class, 'create'])->name('create');
    Route::post('/store',     [StockAdjustmentController::class, 'store'])->name('store');

    Route::get('/{id}',       [StockAdjustmentController::class, 'show'])->name('show');
    Route::get('/{id}/edit',  [StockAdjustmentController::class, 'edit'])->name('edit');
    Route::put('/{id}',       [StockAdjustmentController::class, 'update'])->name('update');
    Route::delete('/{id}',    [StockAdjustmentController::class, 'destroy'])->name('destroy');
});
Route::get('/barang/{kode}', function($kode){
    $barang = DB::table('barang')->where('kode_barang', $kode)->first();
    return $barang ? response()->json($barang) : response()->json(['error' => 'not found'], 404);
});

// === BARANG KELUAR ===
// === BARANG KELUAR ===

Route::prefix('input')->name('input.')->group(function () {
    Route::get('/barangkeluar',                 [BarangKeluarController::class, 'index'])->name('barangkeluar.index');
    Route::get('/barangkeluar/create',          [BarangKeluarController::class, 'create'])->name('barangkeluar.create');
    Route::post('/barangkeluar',                [BarangKeluarController::class, 'store'])->name('barangkeluar.store');

    // NEW
    Route::get('/barangkeluar/{id}',            [BarangKeluarController::class, 'show'])->name('barangkeluar.show');
    Route::get('/barangkeluar/{id}/edit',       [BarangKeluarController::class, 'edit'])->name('barangkeluar.edit');
    Route::put('/barangkeluar/{id}',            [BarangKeluarController::class, 'update'])->name('barangkeluar.update');
    Route::delete('/barangkeluar/{id}',         [BarangKeluarController::class, 'destroy'])->name('barangkeluar.destroy');
});

// API FIFO (tetap)
Route::get('/api/fifo-barang', [BarangKeluarController::class, 'fifoBarang'])->name('api.fifo-barang');


Route::prefix('laporan')->name('laporan.')->group(function () {
    // stok per rak (kalau ada)
    Route::get('/stok-per-rak', [\App\Http\Controllers\Laporan\StockOnHandController::class, 'perRak'])
        ->name('stok-per-rak');

    // stok per lorong (index & detail)
    Route::get('/stok-per-lorong', [StokPerLorongController::class, 'index'])
        ->name('stok-per-lorong');

    Route::get('/stok-per-lorong/detail/{kode_barang}/{lorong?}', [StokPerLorongController::class, 'showDetail'])
        ->name('stok-per-lorong.show');
Route::get('/laporan/stok-per-lorong/rak', [StokPerLorongController::class, 'rakDetail'])
    ->name('laporan.stok-per-lorong.rak');
    Route::get('/laporan/stok-per-lorong/rak', [\App\Http\Controllers\Laporan\StokPerLorongController::class, 'rakDetail'])
    ->name('laporan.stok-per-lorong.rak');
 // >>> Tambahan untuk tombol "Detail Rak"
    Route::get('stok-per-lorong/rak', [StokPerLorongController::class, 'rakDetail'])
        ->name('stok-per-lorong.rak');
          Route::get('stok-per-lorong/rak/export', [StokPerLorongController::class, 'rakExport'])
        ->name('stok-per-lorong.rak.export');

});



Route::get('/dashboard', function () {
return view('dashboard'); // dashboard.blade.php (pakai CSS lama juga)
})->middleware('auth')->name('dashboard');
require __DIR__.'/auth.php';

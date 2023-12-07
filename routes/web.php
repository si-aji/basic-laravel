<?php

use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

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

Route::group([
    'prefix' => 'adm',
    'as' => 'adm.'
], function(){
    // Dashboard
    Route::get('/', [\App\Http\Controllers\Adm\DashboardController::class, 'index'])->name('index');

    // Export Province
    Route::get('/province/export', function(){
        $data = \App\Models\Province::orderBy('name', 'asc')
            ->get();

        return Excel::download(new \App\Exports\ProvinceExport($data), 'province-list.xlsx');
    })->name('province.export');

    // Province => atau route di bawah bisa disingkat jadi Route::resource('province', \App\Http\Controllers\Adm\ProvinceController::class);
    Route::get('/province', [\App\Http\Controllers\Adm\ProvinceController::class, 'index'])->name('province.index');
    Route::get('/province/create', [\App\Http\Controllers\Adm\ProvinceController::class, 'create'])->name('province.create');
    Route::post('/province', [\App\Http\Controllers\Adm\ProvinceController::class, 'store'])->name('province.store');
    Route::get('/province/{id}', [\App\Http\Controllers\Adm\ProvinceController::class, 'show'])->name('province.show');
    Route::get('/province/{id}/edit', [\App\Http\Controllers\Adm\ProvinceController::class, 'edit'])->name('province.edit');
    Route::put('/province/{id}', [\App\Http\Controllers\Adm\ProvinceController::class, 'update'])->name('province.update');
    Route::delete('/province/{id}', [\App\Http\Controllers\Adm\ProvinceController::class, 'destroy'])->name('province.delete');

    // Regency
    Route::get('/regency', [\App\Http\Controllers\Adm\RegencyController::class, 'index'])->name('regency.index');
    Route::get('/regency/create', [\App\Http\Controllers\Adm\RegencyController::class, 'create'])->name('regency.create');
    Route::post('/regency', [\App\Http\Controllers\Adm\RegencyController::class, 'store'])->name('regency.store');
    Route::get('/regency/{id}', [\App\Http\Controllers\Adm\RegencyController::class, 'show'])->name('regency.show');
    Route::get('/regency/{id}/edit', [\App\Http\Controllers\Adm\RegencyController::class, 'edit'])->name('regency.edit');
    Route::put('/regency/{id}', [\App\Http\Controllers\Adm\RegencyController::class, 'update'])->name('regency.update');
    Route::delete('/regency/{id}', [\App\Http\Controllers\Adm\RegencyController::class, 'destroy'])->name('regency.delete');

    // Datatable
    Route::group([
        'prefix' => 'datatable',
        'as' => 'datatable.'
    ], function(){
        // Province List
        Route::get('province', [\App\Http\Controllers\Adm\ProvinceController::class, 'datatableAll'])->name('province.all');

        // Regency List
        Route::get('regency', [\App\Http\Controllers\Adm\RegencyController::class, 'datatableAll'])->name('regency.all');
    });

    // Select2
    Route::group([
        'prefix' => 'select2',
        'as' => 'select2.'
    ], function(){
        // Province List
        Route::get('province', [\App\Http\Controllers\Adm\ProvinceController::class, 'select2'])->name('province.all');

        // Regency List
        Route::get('regency', [\App\Http\Controllers\Adm\RegencyController::class, 'select2'])->name('regency.all');
    });
});
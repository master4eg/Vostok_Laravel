<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\UserExportController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {return view('welcome');});

//excel
Route::get('users/export/{id?}', [UserExportController::class, 'export'])->name('users.export')->where(['id' => '[0-9]+'])->defaults('id', 0);

//pdf
Route::get('users/{id}/pdf/download', [InvoiceController::class, 'downloadDocument'])->name('PDF.download')->where(['id' => '[0-9]+']);
Route::get('users/{id}/pdf/show', [InvoiceController::class, 'showDocument'])->name('PDF.show')->where(['id' => '[0-9]+']);
Route::get('users/{id}/pdf/save', [InvoiceController::class, 'saveDocument'])->name('PDF.save')->where(['id' => '[0-9]+']);

//users
Route::resource('users', UsersController::class);





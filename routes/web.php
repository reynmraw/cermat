<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LegalFormController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogController;



Route::get('/', function () {
    return view('login');
})->middleware('guest');;

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard')->middleware('auth.role:user');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
// Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('auth.role:admin');
// Route::get('/admin/dashboard', function () {
//     return view('admin.dashboard');
// })->name('admin.dashboard')->middleware('auth.role:admin');

//Direct middleware
// Route::get('/admin/dashboard', function () {
//     return 'Admin Dashboard';
// })->name('admin.dashboard')->middleware(\App\Http\Middleware\RoleMiddleware::class.':admin');

// Route::get('/admin/dashboard', function () {
//     if (Auth::check()) {
//         return view('admin.dashboard');
//     } else {
//         return 'Not Authenticated';
//     }
// })->middleware(\App\Http\Middleware\RoleMiddleware::class.':admin')->name('admin.dashboard');

Route::get('/admin/formLegal', [LegalFormController::class, 'showForm'])->middleware(\App\Http\Middleware\RoleMiddleware::class.':admin')->name('form.legal.form');
Route::post('/admin/formLegal', [LegalFormController::class, 'submitForm'])->middleware(\App\Http\Middleware\RoleMiddleware::class.':admin')->name('form.legal.submit');
Route::get('/admin/formLegal/show', [LegalFormController::class, 'index'])->middleware(\App\Http\Middleware\RoleMiddleware::class.':admin')->name('form.legal.index');
Route::get('/admin/formLegal/{id}/edit', [LegalFormController::class, 'edit'])->middleware(\App\Http\Middleware\RoleMiddleware::class.':admin')->name('form.legal.edit');
Route::put('/admin/formLegal/{id}', [LegalFormController::class, 'update'])->middleware(\App\Http\Middleware\RoleMiddleware::class.':admin')->name('form.legal.update');

Route::get('/admin/logs', [LogController::class, 'index'])->middleware(\App\Http\Middleware\RoleMiddleware::class.':admin')->name('logs');


Route::get('/admin/articles/edit', [AdminController::class, 'editArticles'])->name('admin.articles.edit')->middleware(\App\Http\Middleware\RoleMiddleware::class.':editor');

// Route::post('/consume-api', [ApiController::class, 'login']);
Route::get('/login', [ApiController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [ApiController::class, 'login'])->name('login.submit');

Route::post('/logout', [ApiController::class, 'logout'])->name('logout');

// Route::get('/test-role', function () {
//     $middleware = new \App\Http\Middleware\RoleMiddleware;

//     return $middleware->handle(request(), function () {
//         return response('Middleware executed successfully!', 200);
//     }, 'admin');
// });

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Apis\BlogController;
use App\Http\Controllers\Apis\AuthController;
use App\Http\Controllers\Apis\CommonController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'login'])->name('app.login');
Route::post('verify-otp', [AuthController::class, 'verify_otp'])->name('app.verify-otp');

Route::get('blogs', [BlogController::class, 'index'])->name('api.blogs.index');
Route::get('blogs/categories', [BlogController::class, 'categories'])->name('api.blogs.categories');
Route::get('blogs/{slug}', [BlogController::class, 'view'])->name('api.blogs.view');

Route::get('menu/{position}', [CommonController::class, 'menu'])->name('api.menu');
Route::get('settings', [CommonController::class, 'settings'])->name('api.settings');
Route::get('page/{slug}', [CommonController::class, 'page'])->name('api.page');
Route::get('company-page/{slug}', [CommonController::class, 'company_page'])->name('api.company-page');
Route::get('faq', [CommonController::class, 'faq'])->name('api.faq');

Route::get('list-urls/{page}', [CommonController::class, 'list_urls'])->name('api.list-urls');

Route::post('contact/save', [CommonController::class, 'contact_save'])->name('contacts.save');

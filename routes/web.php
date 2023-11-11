<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [\App\Http\Controllers\IndexController::class, 'index']) ->name('index');
Route::get('/redirect', [\App\Http\Controllers\IndexController::class, 'role_redirect']) ->name('redirect.role');
Route::get('/technical_work', [\App\Http\Controllers\IndexController::class, 'technical_work']) ->name('technical.work');

Route::group(['middleware' => ['role:user']], function () {
    Route::get('/payment_create', [\App\Http\Controllers\PaymentController::class, 'payment_create']) ->name('payment.create');
    Route::get('/payment_check', [\App\Http\Controllers\PaymentController::class, 'payment_check']) ->name('payment.check');
    Route::get('/payment_cancel', [\App\Http\Controllers\PaymentController::class, 'payment_cancel']) ->name('payment.cancel');
});

Route::group(['middleware' => ['role:admin|s-admin|dev']], function () {
    Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'admin']) ->name('panel.admin');
    Route::post('/redirect_to_user', [\App\Http\Controllers\AdminController::class, 'redirect_to_user_info']) ->name('user.redirect');
    Route::get('/user_info/{user_id}', [\App\Http\Controllers\AdminController::class, 'user_info']) ->name('admin.user.info');
    Route::post('/user/add_session/{user_id}', [\App\Http\Controllers\AdminController::class, 'user_add_session']) ->name('user.add_session');
    Route::post('/user/give_gift/{user_id}', [\App\Http\Controllers\AdminController::class, 'user_give_gift']) ->name('user.give_gift');
});

Route::group(['middleware' => ['role:s-admin|dev']], function () {
    Route::get('/s-admin', [\App\Http\Controllers\SuperAdminController::class, 's_admin']) ->name('panel.s-admin');
    Route::patch('/user/give_sub/{user_id}', [\App\Http\Controllers\SuperAdminController::class, 'user_give_sub']) ->name('user.give_sub');
});

Route::group(['middleware' => ['role:dev']], function () {
    Route::get('/dev', [\App\Http\Controllers\DevController::class, 'dev']) ->name('panel.dev');
    Route::patch('/Global_edit', [\App\Http\Controllers\DevController::class, 'global_edit']) ->name('global.edit');
    Route::delete('/drop_dattlePass', [\App\Http\Controllers\DevController::class, 'drop_dattlePass']) ->name('dattlePass.drop');
    Route::patch('/user_drop_sub', [\App\Http\Controllers\DevController::class, 'user_drop_sub']) ->name('user.subdrop');
    Route::post('/full_battlepass', [\App\Http\Controllers\DevController::class, 'full_battlepass']) ->name('dattlePass.full');
    Route::patch('/setting_update', [\App\Http\Controllers\DevController::class, 'setting_update']) ->name('setting.update');
});

require __DIR__.'/auth.php';

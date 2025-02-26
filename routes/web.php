<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;


use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserRoleController;
use App\Http\Middleware\CheckUserAccess;
use Illuminate\Support\Facades\Session;




/* User Login  */
Route::match(array('get', 'post'), '/', array(UserController::class, 'login'))->name('login');
Route::match(array('get', 'post'), '/login1', array(UserController::class, 'login1'))->name('login1');


Route::prefix('admin')->group(function () {

    Route::group(array('middleware' => ['auth', 'CheckUserAccess']), function () {


        /*Dashboard*/
        Route::prefix('dashboard')->group(function () {

            Route::match(array('get', 'post'), '/', array(DashboardController::class, 'Dashboard'))->name('Dashboard');


        });

        /*User*/
        Route::prefix('user')->group(function () {

            Route::match(array('get', 'post'), '/', array(UserController::class, 'index'))->name('userList');
            Route::match(array('get', 'post'), '/listDatatable', array(UserController::class, 'listDatatable'))->name('userListDatatable');
            Route::match(array('get', 'post'), '/create', array(UserController::class, 'createUpdate'))->name('userCreate');
            Route::match(array('get', 'post'), '/update/{id?}', array(UserController::class, 'createUpdate'))->name('userUpdate');
            Route::match(array('get', 'post'), '/delete/{id?}', array(UserController::class, 'delete'))->name('userDelete');
            Route::match(array('get', 'post'), '/status/{id?}', array(UserController::class, 'status'))->name('userStatus');
            Route::match(array('get', 'post'), '/logout', array(UserController::class, 'logout'))->name('logout');
            Route::match(array('get', 'post'), '/toggle-theme', array(UserController::class, 'toggleTheme'))->name('toggleTheme');
            Route::match(array('get', 'post'), '/profile', array(UserController::class, 'profile'))->name('profile');
            Route::match(array('get', 'post'), '/checkCurrentPassword', array(UserController::class, 'checkCurrentPassword'))->name('checkCurrentPassword');

        });


        /*User Role*/
        Route::prefix('user-role')->group(function () {

            Route::match(array('get', 'post'), '/', array(UserRoleController::class, 'index'))->name('userRole');
            Route::match(array('get', 'post'), 'create', array(UserRoleController::class, 'index'))->name('userRoleCreate');
            Route::match(array('get', 'post'), 'update/{id?}', array(UserRoleController::class, 'index'))->name('userRoleUpdate');
            Route::match(array('get', 'post'), 'delete/{id?}', array(UserRoleController::class, 'delete'))->name('userRoleDelete');
            Route::match(array('get', 'post'), 'status', array(UserRoleController::class, 'createUpdate'))->name('userRoleStatus');
            Route::match(array('get', 'post'), 'userRoleAccess/{id?}', array(UserRoleController::class, 'userRoleAccess'))->name('userRoleAccess');
            Route::match(array('get', 'post'), 'userCheckRole', array(UserRoleController::class, 'userCheckRole'))->name('userCheckRole');

        });










    });

});


/*User*/
Route::prefix('user')->group(function () {

    Route::match(array('get', 'post'), '/register', array(UserController::class, 'register'))->name('register');
    Route::match(array('get', 'post'), '/registerEmail', array(UserController::class, 'registerEmail'))->name('registerEmail');
    Route::match(array('get', 'post'), '/registerConfirm/{code?}', [UserController::class, 'registerConfirm'])->name('registerConfirm');
    Route::match(array('get', 'post'), '/loginEmail', array(UserController::class, 'loginEmail'))->name('loginEmail');
    Route::match(array('get', 'post'), '/forgot-password', array(UserController::class, 'forgotPassword'))->name('forgotPassword');

    Route::get('/reset-password/{token}', [UserController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('/reset-password', [UserController::class, 'resetPassword'])->name('password.update');

});





Route::get('cacheClear', function () {
    // Clearing caches
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');
    Artisan::call('event:clear');
    Artisan::call('event:cache');

    // Set success message
    Session::flash("success_message", "Event cache, Routes cache, Config cache, Config Clear, View Clear, Optimize Clear, Event Clear, Cache cleared!");

    return redirect()->back();
})->name('cacheClear');
Route::match(array('get', 'post'), '/refresh', array(DashboardController::class, 'localcommands'))->name('localcommands');
Route::get('cacheClear1', function () {
    \Artisan::call('cache:clear');
    \Artisan::call('config:clear');
    \Artisan::call('route:clear');
    \Artisan::call('view:clear');
    \Artisan::call('optimize:clear');
    \Artisan::call('event:clear');
    \Artisan::call('event:cache');
    \Artisan::call('migrate:refresh');
    Session::flash("success_message", "Event cache , Routes cache , Config cache , Config Clear,  View Clear , Optimize Clear , Event Clear , Cache cleared");
    return redirect()->back();
})->name('cacheClear1');
Route::get('cacheClear2', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');
    Artisan::call('event:clear');
    Artisan::call('event:cache');

    // Debugging: Show Database Connection Info
    return response()->json([
        'DB_HOST' => env('DB_HOST'),
        'DB_DATABASE' => env('DB_DATABASE'),
        'DB_USERNAME' => env('DB_USERNAME'),
        'DB_PORT' => env('DB_PORT'),
    ]);
});




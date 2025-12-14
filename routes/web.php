<?php

use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\CityController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\LocationController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\ResortController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\StateController;
use App\Http\Controllers\admin\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;


// Route::get('/', [HomePageController::class, 'indexx'])->name('index');

Route::get('/linkstorage', fn() => Artisan::call('storage:link'));
Route::get('/migrate', fn() => 'Migration complete' && Artisan::call('migrate'));
Route::get('/config-cache', fn() => 'Config cache cleared' && Artisan::call('config:cache'));
Route::get('/clear-cache', fn() => 'Application cache cleared' && Artisan::call('cache:clear'));
Route::get('/view-clear', fn() => 'View cache cleared' && Artisan::call('view:clear'));
Route::get('/all-clear', function () {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    return 'All cache cleared';
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [AuthController::class, 'index'])->name('admin.login');
    Route::post('/', [AuthController::class, 'login'])->name('login')->middleware('throttle:5,1');
});

// admin routes

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('home');
    Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');
    Route::post('change-password', [AuthController::class, 'change_password'])->name('change_password');

    Route::resource('permission', PermissionController::class);
    Route::resource('role', RoleController::class);

    Route::resource('state', StateController::class);

    Route::resource('city', CityController::class);
    Route::resource('location', LocationController::class);

    Route::resource('user', UserController::class);

    Route::get('add_permission_to_roles/{id}', [RoleController::class, 'add_permission_to_roles'])->name('add_permission_to_roles');
    Route::post('store_permisson_for_role/{id}', [RoleController::class, 'store_permisson_for_role'])->name('store_permisson_for_role');
    Route::post('upload_document/{user}', [UserController::class, 'upload_image'])->name('upload.document');
    Route::delete('delete_document', [UserController::class, 'destroy_document'])->name('destroy.document');
    Route::post('edit_document/{user}', [UserController::class, 'upload_edit'])->name('edit.document');
    Route::post('session_store', [UserController::class, 'session_store'])->name('session.store');
    Route::post('attendance_store', [UserController::class, 'attendance_store'])->name('attendance.store');

    Route::post('get_state', [DashboardController::class, 'get_state'])->name('get.state');

    // ----------------------------------resort ------------------------------------------------------//
    Route::post('/admin/resort/{resort}/images/add', [ResortController::class, 'ajaxAddImages'])
        ->name('resort.images.add');

    Route::post('/admin/resort/image/temp-delete', [ResortController::class, 'tempDeleteImage'])
        ->name('resort.image.tempDelete');

    Route::post('/admin/resort/image/undo-delete', [ResortController::class, 'undoDeleteImage'])
        ->name('resort.image.undoDelete');

    Route::post('/admin/resort/image/final-delete', [ResortController::class, 'finalDeleteImage'])
        ->name('resort.image.finalDelete');
    Route::delete('/admin/resort/{id}', [ResortController::class, 'destroy'])
        ->name('resort.destroy');


        Route::get('resorts', [ResortController::class, 'index'])->name('resort.index');
        Route::get('resorts/create', [ResortController::class, 'create'])->name('resort.create');
        Route::post('resorts', [ResortController::class, 'store'])->name('resort.store');
        Route::get('resorts/{id}/edit', [ResortController::class, 'edit'])->name('resort.edit');
        Route::put('resorts/{id}', [ResortController::class, 'update'])->name('resort.update');

        Route::get('resorts/{id}/status', [ResortController::class, 'toggleStatus'])->name('resort.status');

        // web.php

});

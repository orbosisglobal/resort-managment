<?php

use App\Http\Controllers\admin\LocationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\front\HomePageController;
use App\Http\Controllers\front\RequestController;
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\DashboardController;

use App\Http\Controllers\admin\SettingController;

use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\StateController;
use App\Http\Controllers\admin\DepartmentController;
use App\Http\Controllers\admin\CityController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\GradeController;
use App\Http\Controllers\admin\GenralSettingController;
use App\Http\Controllers\admin\ReportsController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\VendorController;
use App\Http\Controllers\admin\CustomerController;
use App\Http\Controllers\admin\VoucherController;
use App\Http\Controllers\admin\CustomerCategoryController;
use App\Http\Controllers\admin\LengthRateController;
use App\Http\Controllers\admin\NumberSystemController;
use App\Http\Controllers\admin\PurchaseOrderController;
use App\Http\Controllers\admin\SalesOrderController;
use App\Http\Controllers\Api\VisitManagementController;
use App\Http\Controllers\admin\QuotationController;
use App\Http\Controllers\admin\DeliveryOrderController;
use Laravel\Sanctum\PersonalAccessToken;
use App\Models\Vendor;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;


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

//admin routes

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


});


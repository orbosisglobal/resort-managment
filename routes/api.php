<?php

use App\Http\Controllers\admin\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\VisitManagementController;
use Carbon\Carbon;


    Route::post("login",[LoginController::class, "login"]);
    Route::middleware(['validate.auth.token'])->group(function () {
            Route::get('user/check-access', [LoginController::class, 'checkAccess']);

        Route::apiResource('visit', VisitManagementController::class);
        Route::post('visit-management/follow-up', [VisitManagementController::class, 'addFollowUp']);
        // Route::put('visit-management/follow-up/{id}', [VisitManagementController::class, 'updateFollowUp']);
        Route::patch('visit-management/follow-up/{id}/status', [VisitManagementController::class, 'changeStatus']);

        Route::post('visitfollowupdetails', [VisitManagementController::class, 'filterFollowups'])->name('filterFollowups');
        Route::post('followupsByVisit', [VisitManagementController::class, 'followupsByVisit'])->name('followupsByVisit');
        Route::post('followup/delete', [VisitManagementController::class, 'deleteFollowup']);
        Route::post('followup/update', [VisitManagementController::class, 'updateFollowup']);


        Route::post('visitdetails', [VisitManagementController::class, 'visitdetails'])->name('visitdetails');
        Route::post('shortdetails', [VisitManagementController::class, 'shortdetails'])->name('shortdetails');
        // Route::get('visitsearch', [VisitManagementController::class, 'searchVisitDetails']);
        Route::get('dashboard/counts', [VisitManagementController::class, 'dashboardCounts']);

        Route::post('attendance_store_api', [VisitManagementController::class, 'attendance_store_api'])->name('attendance.store.api');
    });

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

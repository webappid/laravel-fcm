<?php
/**
 * Created by PhpStorm.
 */

Route::name('lazy.')->group(function () {
    Route::group(['middleware' => ['web', 'auth']], function () {
        Route::name('admin.')->prefix('admin')->group(function () {
            Route::name('fcm-project.')->prefix('fcm-project')->group(function () {
                Route::get('/project', WebAppId\Fcm\Controllers\FcmProjects\FcmProjectIndexController::class)->name('index');
                Route::get('/create', WebAppId\Fcm\Controllers\FcmProjects\FcmProjectCreateController::class)->name('create');
                Route::get('/{id}/edit', WebAppId\Fcm\Controllers\FcmProjects\FcmProjectEditController::class)->name('edit');
                Route::post('/store', WebAppId\Fcm\Controllers\FcmProjects\FcmProjectStoreController::class)->name('store');
                Route::post('/{id}/update', WebAppId\Fcm\Controllers\FcmProjects\FcmProjectUpdateController::class)->name('update');
                Route::get('/{id}/delete', WebAppId\Fcm\Controllers\FcmProjects\FcmProjectDeleteController::class)->name('delete');
            });
            Route::name('fcm-subscribe.')->prefix('fcm-subscribe')->group(function(){
                Route::post('/store', WebAppId\Fcm\Controllers\FcmSubscribes\FcmSubscribeStoreController::class)->name('store');
                Route::post('/update', WebAppId\Fcm\Controllers\FcmSubscribes\FcmSubscribeUpdateController::class)->name('update');
            });
            Route::name('notification.')->prefix('notification')->group(function() {
                Route::get('/', WebAppId\Fcm\Controllers\Notifications\NotificationIndexController::class)->name('index');
            });
        });
    });
});

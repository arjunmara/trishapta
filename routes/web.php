<?php

/**
 * Helper Functions Routes
 *
 */

use Illuminate\Support\Facades\Artisan;

//Clear Cache facade value:
Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function () {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function () {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function () {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function () {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});
//Notify Day End
//Clear View cache:
Route::get('/notify-endday', function () {
    $exitCode = Artisan::call('notify:endday');
    return '<h1>Day End Notified</h1>';
});

//Clear Dump autoload:
Route::get('/dump-autoload', function () {
    $exitCode = Artisan::call('dump-autoload');
    return '<h1>Composer Dump-Autoload Done!</h1>';
});

//frontend Routes
Route::get('/', ['as' => 'frontend.index', 'uses' => 'Frontend\FrontendController@index']);
Route::get('/product/{title}/detail', ['as' => 'frontend.product.detail', 'uses' => 'Frontend\FrontendController@productDetail']);
Route::get('/product/{type}', ['as' => 'frontend.product.type', 'uses' => 'Frontend\FrontendController@productList']);
Route::get('/product/{category}/{id}', ['as' => 'frontend.product.category', 'uses' => 'Frontend\FrontendController@productListByCategories']);
Route::get('/product', ['as' => 'frontend.product.search', 'uses' => 'Frontend\FrontendController@productSearch']);
Route::get('/about', ['as' => 'frontend.about', 'uses' => 'Frontend\FrontendController@about']);
Route::get('/privacy-policy', ['as' => 'frontend.privacy-policy', 'uses' => 'Frontend\FrontendController@privacyPolicy']);
Route::get('/contact', ['as' => 'frontend.contact', 'uses' => 'Frontend\FrontendController@contact']);
Route::post('/contact-form', ['as' => 'frontend.contact-form', 'uses' => 'Frontend\FrontendController@contactForm']);

Auth::routes();


/*Backend Routes*/

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {

    Route::get('sts', ['as' => 'backend.dashboard.sts', 'uses' => 'Backend\DashboardController@sts']);
    Route::post('/logout', ['as' => 'backend.dashboard.logout', 'uses' => 'Backend\DashboardController@logout']);
    //Password Reset
    Route::get('users/password-reset', ['as' => 'backend.users.password-reset', 'uses' => 'Backend\UserController@passwordReset']);
    Route::post('users/password-reset', ['as' => 'backend.users.password-reset', 'uses' => 'Backend\UserController@postPasswordReset']);

    //Track Employees
    Route::get('track-employees', ['as' => 'backend.track-employee', 'uses' => 'Backend\TrackEmployeeController@index']);
    //Overall Dashboard
    Route::get('report', ['as' => 'backend.report', 'uses' => 'Backend\ReportController@index']);
    //Ajax Routes STS
    Route::get('getEmployeeBasedOnBranch', ['as' => 'backend.get-employees', 'uses' => 'Backend\TrackEmployeeController@getEmployeeBasedOnBranch']);
    Route::post('getEmployeeTaskReport', ['as' => 'backend.get-employees-task-report', 'uses' => 'Backend\TrackEmployeeController@getEmployeeTaskReport']);

    //Schedule Route
    Route::get('schedule', ['as' => 'backend.schedule', 'uses' => 'Backend\ScheduleController@index']);
    Route::get('schedule/add/{id}', ['as' => 'backend.schedule.add', 'uses' => 'Backend\ScheduleController@create'])->middleware(['endDay']);
    Route::post('schedule/store', ['as' => 'backend.schedule.store', 'uses' => 'Backend\ScheduleController@store'])->middleware(['endDay']);
    Route::get('schedule/edit/{id}', ['as' => 'backend.schedule.edit', 'uses' => 'Backend\ScheduleController@edit'])->middleware(['endDay']);
    Route::post('schedule/update/{id}', ['as' => 'backend.schedule.update', 'uses' => 'Backend\ScheduleController@update'])->middleware(['endDay']);
    Route::get('schedule/all', ['as' => 'backend.schedule.all', 'uses' => 'Backend\ScheduleController@allSchedule']);
    Route::get('schedule/feedback', ['as' => 'backend.schedule.feedback', 'uses' => 'Backend\ScheduleController@feedback'])->middleware(['endDay']);
    Route::post('schedule/feedback', ['as' => 'backend.schedule.feedback', 'uses' => 'Backend\ScheduleController@storeFeedback'])->middleware(['endDay']);

//user routes
    Route::get('users', ['as' => 'backend.users', 'uses' => 'Backend\UserController@index'])->middleware(['permission:read-users']);
    Route::get('users/add', ['as' => 'backend.users.add', 'uses' => 'Backend\UserController@create'])->middleware(['permission:create-users']);;
    Route::post('users/store', ['as' => 'backend.users.store', 'uses' => 'Backend\UserController@store'])->middleware(['permission:create-users']);
    Route::get('users/edit/{id}', ['as' => 'backend.users.edit', 'uses' => 'Backend\UserController@edit'])->middleware(['permission:update-users']);
    Route::post('users/update/{id}', ['as' => 'backend.users.update', 'uses' => 'Backend\UserController@update'])->middleware(['permission:update-users']);
    Route::get('users/delete/{id}', ['as' => 'backend.users.delete', 'uses' => 'Backend\UserController@destroy'])->middleware(['permission:delete-users']);;


    //End Day
    Route::get('end-day', ['as' => 'backend.dayend', 'uses' => 'Backend\BackendBaseController@EndDay']);
    //Notification Mark as Read
    Route::get('mark-as-read/{id}', ['as' => 'backend.markread', 'uses' => 'Backend\DashboardController@markAsReadNotification']);

    //Routes for Super Adminstrator, Adminstrator
    Route::group(['middleware' => ['role:superadministrator|administrator']], function () {

        Route::get('/', ['as' => 'backend.dashboard', 'uses' => 'Backend\DashboardController@index']);
        Route::get('dashboard', ['as' => 'backend.dashboard', 'uses' => 'Backend\DashboardController@index']);
        //Ajax Routes
        Route::post('secondary-category-ajax/{id?}', ['as' => 'backend.sc_ajax', 'uses' => 'Backend\AjaxController@getSecondaryCategoryOnAjax']);
        Route::post('product-stock-status-ajax', ['uses' => 'Backend\AjaxController@setStockStatusOnAjax']);
        Route::post('product-show-status-ajax', ['uses' => 'Backend\AjaxController@setProductStatusOnAjax']);

        //Primary Category Routes
        Route::get('primary-category', ['as' => 'backend.primary-category', 'uses' => 'Backend\PrimaryCategoryController@index']);
        Route::get('primary-category/add', ['as' => 'backend.primary-category.add', 'uses' => 'Backend\PrimaryCategoryController@create']);
        Route::post('primary-category/store', ['as' => 'backend.primary-category.store', 'uses' => 'Backend\PrimaryCategoryController@store']);
        Route::get('primary-category/edit/{id}', ['as' => 'backend.primary-category.edit', 'uses' => 'Backend\PrimaryCategoryController@edit']);
        Route::post('primary-category/update/{id}', ['as' => 'backend.primary-category.update', 'uses' => 'Backend\PrimaryCategoryController@update']);
        Route::get('primary-category/delete/{id}', ['as' => 'backend.primary-category.delete', 'uses' => 'Backend\PrimaryCategoryController@destroy']);

        //Secondary Category Routes
        Route::get('secondary-category', ['as' => 'backend.secondary-category', 'uses' => 'Backend\SecondaryCategoryController@index']);
        Route::get('secondary-category/add', ['as' => 'backend.secondary-category.add', 'uses' => 'Backend\SecondaryCategoryController@create']);
        Route::post('secondary-category/store', ['as' => 'backend.secondary-category.store', 'uses' => 'Backend\SecondaryCategoryController@store']);
        Route::get('secondary-category/edit/{id}', ['as' => 'backend.secondary-category.edit', 'uses' => 'Backend\SecondaryCategoryController@edit']);
        Route::post('secondary-category/update/{id}', ['as' => 'backend.secondary-category.update', 'uses' => 'Backend\SecondaryCategoryController@update']);
        Route::get('secondary-category/delete/{id}', ['as' => 'backend.secondary-category.delete', 'uses' => 'Backend\SecondaryCategoryController@destroy']);

        //Product  Routes
        Route::get('product', ['as' => 'backend.product', 'uses' => 'Backend\ProductController@index']);
        Route::get('product/add', ['as' => 'backend.product.add', 'uses' => 'Backend\ProductController@create']);
        Route::post('product/store', ['as' => 'backend.product.store', 'uses' => 'Backend\ProductController@store']);
        Route::get('product/edit/{id}', ['as' => 'backend.product.edit', 'uses' => 'Backend\ProductController@edit']);
        Route::post('product/update/{id}', ['as' => 'backend.product.update', 'uses' => 'Backend\ProductController@update']);
        Route::get('product/delete/{id}', ['as' => 'backend.product.delete', 'uses' => 'Backend\ProductController@destroy']);
        Route::get('product/delete-image/{id}', ['as' => 'backend.product.delete-image', 'uses' => 'Backend\ProductController@destroyImage']);
        Route::get('product/search', ['as' => 'backend.product.search', 'uses' => 'Backend\ProductController@productSearch']);

        //Home slider Routes
        Route::get('homeslider', ['as' => 'backend.homeslider', 'uses' => 'Backend\HomeSliderController@index']);
        Route::get('homeslider/add', ['as' => 'backend.homeslider.add', 'uses' => 'Backend\HomeSliderController@create']);
        Route::post('homeslider/store', ['as' => 'backend.homeslider.store', 'uses' => 'Backend\HomeSliderController@store']);
        Route::get('homeslider/edit/{id}', ['as' => 'backend.homeslider.edit', 'uses' => 'Backend\HomeSliderController@edit']);
        Route::post('homeslider/update/{id}', ['as' => 'backend.homeslider.update', 'uses' => 'Backend\HomeSliderController@update']);
        Route::get('homeslider/delete/{id}', ['as' => 'backend.homeslider.delete', 'uses' => 'Backend\HomeSliderController@destroy']);
        Route::get('homeslider/delete-image/{id}', ['as' => 'backend.homeslider.delete-image', 'uses' => 'Backend\HomeSliderController@destroyImage']);

        // Permissions Route
        Route::get('permissions', ['as' => 'backend.permissions', 'uses' => 'Backend\PermissionController@index']);
        Route::get('permissions/add', ['as' => 'backend.permissions.add', 'uses' => 'Backend\PermissionController@create']);
        Route::post('permissions/store', ['as' => 'backend.permissions.store', 'uses' => 'Backend\PermissionController@store']);
        Route::get('permissions/edit/{id}', ['as' => 'backend.permissions.edit', 'uses' => 'Backend\PermissionController@edit']);
        Route::post('permissions/update/{id}', ['as' => 'backend.permissions.update', 'uses' => 'Backend\PermissionController@update']);

        //Roles Route
        Route::get('roles', ['as' => 'backend.roles', 'uses' => 'Backend\RoleController@index']);
        Route::get('roles/add', ['as' => 'backend.roles.add', 'uses' => 'Backend\RoleController@create']);
        Route::post('roles/store', ['as' => 'backend.roles.store', 'uses' => 'Backend\RoleController@store']);
        Route::get('roles/edit/{id}', ['as' => 'backend.roles.edit', 'uses' => 'Backend\RoleController@edit']);
        Route::post('roles/update/{id}', ['as' => 'backend.roles.update', 'uses' => 'Backend\RoleController@update']);

        //Branches Route
        Route::get('branches', ['as' => 'backend.branches', 'uses' => 'Backend\BranchController@index']);
        Route::get('branches/add', ['as' => 'backend.branches.add', 'uses' => 'Backend\BranchController@create']);
        Route::post('branches/store', ['as' => 'backend.branches.store', 'uses' => 'Backend\BranchController@store']);
        Route::get('branches/edit/{id}', ['as' => 'backend.branches.edit', 'uses' => 'Backend\BranchController@edit']);
        Route::post('branches/update/{id}', ['as' => 'backend.branches.update', 'uses' => 'Backend\BranchController@update']);
        //Client Route
        Route::get('client', ['as' => 'backend.client', 'uses' => 'Backend\ClientController@index']);
        Route::get('client/add', ['as' => 'backend.client.add', 'uses' => 'Backend\ClientController@create']);
        Route::post('client/store', ['as' => 'backend.client.store', 'uses' => 'Backend\ClientController@store']);
        Route::get('client/edit/{id}', ['as' => 'backend.client.edit', 'uses' => 'Backend\ClientController@edit']);
        Route::post('client/update/{id}', ['as' => 'backend.client.update', 'uses' => 'Backend\ClientController@update']);

        //Response Keywords Route
        Route::get('response-keyword', ['as' => 'backend.response-keyword', 'uses' => 'Backend\ResponseKeywordController@index']);
        Route::get('response-keyword/add', ['as' => 'backend.response-keyword.add', 'uses' => 'Backend\ResponseKeywordController@create']);
        Route::post('response-keyword/store', ['as' => 'backend.response-keyword.store', 'uses' => 'Backend\ResponseKeywordController@store']);
        Route::get('response-keyword/edit/{id}', ['as' => 'backend.response-keyword.edit', 'uses' => 'Backend\ResponseKeywordController@edit']);
        Route::post('response-keyword/update/{id}', ['as' => 'backend.response-keyword.update', 'uses' => 'Backend\ResponseKeywordController@update']);

        //Registered Mobile Devices
        Route::get('device', ['as' => 'backend.device', 'uses' => 'Backend\DeviceController@index']);

        //Push Notifications
        Route::get('push-notification', ['as' => 'backend.push-notification', 'uses' => 'Backend\PushNotificationController@index']);
        Route::get('push-notification/add', ['as' => 'backend.push-notification.add', 'uses' => 'Backend\PushNotificationController@create']);
        Route::post('push-notification/store', ['as' => 'backend.push-notification.store', 'uses' => 'Backend\PushNotificationController@store']);

    });

});

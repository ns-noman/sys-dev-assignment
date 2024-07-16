<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BasicInfoController; 
use App\Http\Controllers\RenterController; 
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\QR_Bar_CodeConrollter;

use App\Http\Controllers\DashboardController;

use App\Http\Controllers\ExpenseHeadController;
use App\Http\Controllers\FlatController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\FlatSaleController;

use App\Http\Controllers\ProjectReportController;
use App\Http\Controllers\flatReport;
use App\Http\Controllers\CollectionsController;
use App\Http\Controllers\AdditionalAndDiscountController;
use App\Http\Controllers\CheckListController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\AssignMasterController;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('admin.auth.login');
});

Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return 'View cache has been cleared';
});


Route::middleware('auth')->group(function () {

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::get('destroy-user-doc/{id}', [UserController::class, 'destroyUserDoc']);
    Route::get('dashboard',[DashboardController::class,'index']);
    Route::resource('projects', ProjectController::class);
    Route::resource('expenseheads', ExpenseHeadController::class);
    Route::resource('basic-infos', BasicInfoController::class);
    Route::resource('renters', RenterController::class);
    Route::get('destroy-renters-doc/{id}', [RenterController::class, 'destroyRentersDoc']);

    Route::resource('flats', FlatController::class);
    Route::get('flat-details/{pID}/{S}', [FlatController::class,'flatDetails']);


    Route::resource('expenses', ExpenseController::class);
    Route::resource('flatSales', FlatSaleController::class);
    Route::get('proImgDel/{id}',[ FlatSaleController::class,'proImgDel']);
    Route::get('project_flats/{id}', [FlatSaleController::class,'project_flats']);
    Route::get('flat_details/{id}', [FlatSaleController::class,'flat_details']);


    Route::resource('projectReport',ProjectReportController::class);
    Route::get('projectDetails/{pID}',[ProjectReportController::class,'projectDetails']);
    Route::resource('flatReport',flatReport::class);
    Route::get('flatDetails/{p}/{f}/{c}', [flatReport::class,'flatDetails']);
    Route::resource('collections', CollectionsController::class);
    Route::get('findCustomers/{id}', [CollectionsController::class,'findCustomers']);
    Route::get('collectionDetails/{projectID}/{flatID}/{clientID}', [CollectionsController::class,'collectionDetails']);
    Route::get('loadFlats/{id}', [CollectionsController::class,'loadFlats']);
    Route::get('updateStatus/{id}', [CollectionsController::class,'updateStatus']);
    Route::get('collectionDelete/{id}', [CollectionsController::class,'collectionDelete']);
    Route::get('resaleCreate/{id}', [FlatSaleController::class,'resaleCreate']);
    Route::get('collectionMoneyReceipt/{id}', [CollectionsController::class,'collectionMoneyReceipt']);
    Route::get('add-disc-status/{id}', [AdditionalAndDiscountController::class,'status']);
    Route::get('Add-And-Disc-Data/{projectID}/{flatID}/{clientID}', [AdditionalAndDiscountController::class,'addAndDiscData']);
    Route::get('AddDiscDelete/{id}', [AdditionalAndDiscountController::class,'destroy']);
    Route::resource('AdditionalAndDiscount',AdditionalAndDiscountController::class);
    
    Route::resource('checklists',CheckListController::class);
    Route::get('show-table',[CheckListController::class, 'showTable']);
    Route::get('checklists/destroy/{id}',[CheckListController::class, 'destroy']);
    Route::get('/checklists/report-view',[CheckListController::class, 'reportView']);
    Route::get('search-view',[CheckListController::class, 'searchView']);
    Route::post('checklists-search',[CheckListController::class, 'checklistsSearch']);
    
    Route::resource('departments',DepartmentController::class);
    Route::get('departments-data',[DepartmentController::class, 'deptData']);
    Route::get('department-destroy/{id}',[DepartmentController::class, 'destroy']);
    Route::resource('assignmasters',AssignMasterController::class);
    Route::get('show-master/{id}',[AssignMasterController::class, 'showTable']);
    Route::get('destroy-master/{id}',[AssignMasterController::class, 'destroy']);

    Route::get('barcodes',[QR_Bar_CodeConrollter::class, 'barIndex']);
    Route::get('qrcodes',[QR_Bar_CodeConrollter::class, 'qrIndex']);
    
    Route::resource('posts', PostController::class);
    Route::get('search-posts',[PostController::class, 'searchPosts']);
    Route::post('post-search-result',[PostController::class, 'postSearchResult']);
    Route::get('/posts/search/details/{id}',[PostController::class, 'postsSearchDetails']);

});

require __DIR__.'/auth.php';

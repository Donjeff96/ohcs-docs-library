<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authenticate\AuthenticateController;
use App\Http\Controllers\Authenticate\PrivillegeController;
use App\Http\Controllers\Authenticate\UserController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\Deferred\DeferredController;
use App\Http\Controllers\DivisionalUnit\DivisionalUnitController;
use App\Http\Controllers\DocumentApprovall\DocumentApprovalController;
use App\Http\Controllers\Documentation\DocumentationController;
use App\Http\Controllers\Documentation\MyDocumentationController;
use App\Http\Controllers\Holiday\HolidayController;
use App\Http\Controllers\Leave\ApplyForLeave;
use App\Http\Controllers\Leave\HrLeaveApproval;
use App\Http\Controllers\Leave\LeaveActionsController;
use App\Http\Controllers\Leave\LeaveController;
use App\Http\Controllers\MyProfile\MyProfileController;
use App\Http\Controllers\Report\ReportController;
use App\Http\Controllers\Reports\LeaveReport;
use App\Http\Controllers\Staff\StaffBioController;
use App\Http\Controllers\Staff\StaffController;
use App\Http\Controllers\UserAlbum\UserAlbumController;
use App\Http\Controllers\UserCategory\UserCategoryController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

/* Login Authentication */

Route::get('/',[AuthenticateController::class,'index']);
Route::get('login',[AuthenticateController::class,'index'])->name('login');
Route::post('authenticate-user-process',[AuthenticateController::class,'authenticateUserProcess'])->name('authenticate-user-process');
Route::post('log-out-user',[DashBoardController::class,'logoutUser'])->name('log-out-user');

Route::get('update-user-information',[UserController::class,'index'])->name('update-user-information');
Route::post('update-user-information-process',[UserController::class,'updateUserInformation'])->name('update-user-information-process');


Route::get('edit-view-assign-supervisor-item/{id}',[UserController::class,'editTierInfromation'])->name('edit-view-assign-supervisor-item');
Route::post('edit-view-assign-supervisor-item-process/{id}',[UserController::class,'editTierInfromationProcess'])->name('edit-view-assign-supervisor-item-process');


/* End Login Authentication */

/* Beginning of privilege controlls  */ 
Route::get('privilege',[PrivillegeController::class,'index'])->name('privilege');
Route::post('privi',[PrivillegeController::class,'getPrivi'])->name('privi');
Route::post('saveprivi',[PrivillegeController::class,'savePrivi'])->name('saveprivi');
Route::get('list-staff',[UserCategoryController::class,'listStaffs'])->name('list-staff');

Route::get('create-account',[UserController::class,'createAccount'])->name('create-account');
Route::post('create-account-process',[UserController::class,'createUserAccountProcess'])->name('create-account-process');

/* End of privilege controlls  */ 


/* Beginning of create category controlls  */ 
Route::get('add_category',[UserCategoryController::class,'index'])->name('add_category');
Route::post('store_user_category',[UserCategoryController::class,'store'])->name('store_user_category');
Route::get('edit_user_category/{id}',[UserCategoryController::class,'editUserCategoryView'])->name('edit_user_category');
Route::post('edit_user_category-process/{id}',[UserCategoryController::class,'updateCategory'])->name('edit_user_category-process');
Route::get('reassign_user_category/{id}',[UserCategoryController::class,'editUserCategoryPriv'])->name('reassign_user_category');
Route::post('reassign_user_unit-process/{id}',[UserCategoryController::class,'setUnit'])->name('reassign_user_unit-process');

Route::post('reassign_user_category-process/{id}',[UserCategoryController::class,'editUserCategoryPrivProcess'])->name('reassign_user_category-process');
/* DashBoard */

Route::get('dashboard',[DashBoardController::class,'index'])->name('dashboard');
Route::get('home',[DashBoardController::class,'index'])->name('home');

/*End  DashBoard */




/* Staff Album */

Route::get('staff-list-search',[UserAlbumController::class,'index'])->name('staff-list-search');
Route::post('staff-list-search-process',[UserAlbumController::class,'listStaffProcess'])->name('staff-list-search-process');

/*End  Staff Album */

/* Staff */

Route::get('create-file',[StaffController::class,'createPersonel'])->name('create-file');
Route::post('create-file-process',[StaffController::class,'createFileProcess'])->name('create-file-process');
Route::get('list-files',[StaffController::class,'listFiles'])->name('list-files');


Route::get('staff-search',[StaffController::class,'searchForStaffView'])->name('staff-search');
Route::post('staff-search-process',[StaffController::class,'searchStaffProcess'])->name('staff-search-process');
Route::get('fetch-user-bio-data/{userName}',[StaffController::class,'staffBioData'])->name('fetch-user-bio-data');




Route::post('update-staff-information-bio/{id}',[StaffController::class,'updateStaffBioDataOne'])->name('update-staff-information-bio');
Route::post('update-contact-information-bio/{id}',[StaffController::class,'updateContactInformation'])->name('update-contact-information-bio');
Route::post('update-emergency-information-bio/{id}',[StaffController::class,'updateEmergencyContact'])->name('update-emergency-information-bio');
Route::post('update-nextofking-information-bio/{id}',[StaffController::class,'updateNexkOfKin'])->name('update-nextofking-information-bio');

Route::post('get-position-and-promotion-forms',[StaffController::class,'getPromotionandPostionForms'])->name('get-position-and-promotion-forms');
Route::post('position-and-promotion-process/{id}',[StaffController::class,'updatePromotionAndPositionProcess'])->name('position-and-promotion-process');
Route::post('delete-position-and-promotion-process',[StaffController::class,'deletePromotionPosition'])->name('delete-position-and-promotion-process');

Route::post('supervisor-information-process/{id}',[StaffController::class,'updateSupervisorInformation'])->name('supervisor-information-process');

Route::post('update-job-and-qualification-info/{id}',[StaffController::class,'updateJobAndQualificationInfoProcess'])->name('update-job-and-qualification-info');


Route::post('update-employee-compensation-info/{id}',[StaffController::class,'addEmployeeCompensationProcess'])->name('update-employee-compensation-info');

Route::post('get-postion-position-data',[StaffController::class,'getPostingPositionData'])->name('get-postion-position-data');

Route::post('position-and-promotion-process-update/{id}',[StaffController::class,'updatePositionAndPromotion'])->name('position-and-promotion-process-update');

Route::get('staff-bio-information/{userID}',[StaffController::class,'viewStaffBioInformation'])->name('staff-bio-information');

Route::post('get-user-position-and-promotion',[StaffBioController::class,'getPositionAndPromotions'])->name('get-user-position-and-promotion');



/* End Staff */

/* Documentation */

Route::get('documentation-search-staff',[DocumentationController::class,'index'])->name('documentation-search-staff');
Route::post('documentation-staff-search-process',[DocumentationController::class,'searchStaffProcess'])->name('documentation-staff-search-process');
Route::get('documentation-fetch-user-bio-data/{userName}',[DocumentationController::class,'staffUploadInformation'])->name('documentation-fetch-user-bio-data');
Route::post('get-document-classification-drop-down',[DocumentationController::class,'getDocumentClassifications'])->name('get-document-classification-drop-down');


Route::post('upload-staff-documents-process/{userID}',[DocumentationController::class,'uploadStaffDocumentsProcess'])->name('upload-staff-documents-process');
Route::get('documentation-fetch-user-bio-data-pdf/{username}/{path}',[DocumentationController::class,'replacePdfObject'])->name('documentation-fetch-user-bio-data-pdf');

Route::get('bulk-documentation-fetch-user-bio-data/{userName}',[DocumentationController::class,'bulkStaffUploadInformation'])->name('bulk-documentation-fetch-user-bio-data');


Route::get('my-documentation',[MyDocumentationController::class,'myDocuments'])->name('my-documentation');
Route::post('list-document-with-type',[MyDocumentationController::class,'getDocumentTypeDocuments'])->name('list-document-with-type');

Route::get('approve-users-documents/{userID}',[DocumentApprovalController::class,'approvalDocumentView'])->name('approve-users-documents');
Route::post('approve-users-document-process',[DocumentApprovalController::class,'approveDocumentProcess'])->name('approve-users-document-process');

/* End Documentation */

/* Profile */

Route::get('my-profile-bioinformation',[MyProfileController::class,'viewStaffBioInformation'])->name('my-profile-bioinformation');
/* end Profile */



/* Approval */
Route::get('pending-documentation-list',[DocumentApprovalController::class,'pendingApprovalView'])->name('pending-documentation-list');
/* End Approval */


/* Divisional  */
Route::get('list-divisional-staffs',[DivisionalUnitController::class,'index'])->name('list-divisional-staffs');
Route::post('list-divisional-staffs-process',[DivisionalUnitController::class,'fetchDivisionalStaffs'])->name('list-divisional-staffs-process');
Route::get('my-divisional-staff',[DivisionalUnitController::class,'myDivisionView'])->name('my-divisional-staff');

/* Dashboard  */
Route::get('dashboard-list-staff/{parameter}',[DashBoardController::class,'listDashboardStaffs'])->name('dashboard-list-staff');



/* Reports */
Route::get('general-report',[ReportController::class,'generalReportView'])->name('general-report');
Route::get('general-report-list-grade-staff/{id}',[ReportController::class,'generalReportListStaffView'])->name('general-report-list-grade-staff');
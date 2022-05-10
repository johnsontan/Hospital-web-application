<?php
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AvailableTimeslotController;
use App\Http\Controllers\commonServiceController;
use App\Http\Controllers\roles\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleBasedController;
use App\Http\Controllers\roles\PatientController;
use App\Http\Controllers\TwoFactorAuthController;
use App\Models\EducationalMaterial;
use App\Http\Controllers\ConditionController;
use App\Http\Controllers\EmailAuthController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\medicalRecordController;
use App\Http\Controllers\NewStaffAccController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\roles\StaffController;
use App\Http\Controllers\SendPromoController;
use App\Http\Controllers\ReferralController;
use App\Mail\WelcomeMail;
use App\Models\AvailableTimeslot;
use App\Models\Feedback;
use App\Models\Patient;
use App\Models\PaymentRecords;
use Illuminate\Support\Facades\Route;

//in the works
Route::get('/staffViewHealthRecords', function () {                //page for staff to view Health Records
    return view('medicalRecords/staffViewHealthRecords');
})->name('staffViewHealthRecords');

Route::get('/printMC', function () {                //page to print MC
    return view('medicalRecords/printMC');
})->name('printMC');

Route::get('/staffSeeMore', function () {           //page for staff to view HR, and edit/delete the entries
    return view('medicalRecords/staffSeeMoreViewHealthRecords');
})->name('staffSeeMoreViewHealthRecords');

Route::get('/staffEditPrescription', function () {       //page for staff to edit Prescription
    return view('medicalRecords/staffEditPrescription');
})->name('staffEditPrescription');

Route::get('/staffEditTestResults', function () {       //page for staff to edit Test Results
    return view('medicalRecords/staffEditTestResults');
})->name('staffEditTestResults');

Route::get('/staffEditMedCert', function () {       //page for staff to edit MC
    return view('medicalRecords/staffEditMedCert');
})->name('staffEditMedCert');




//General Purpose pages
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/aboutus', function () {
    return view('aboutus');
})->name('aboutus');

//Auth::routes();
Route::get('/contactUs', function () {
    return view('contactUs');
})->name('contactUs');

//Dashboard
Route::group(['middleware' =>['auth']], function(){
    Route::get('/dashboard', [RolebasedController::class, 'index'])->name('rolebased');
});

//change password
Route::get('change-password/{user}', [RoleBasedController::class, 'viewcp'])->name('rolebased.viewcp');
Route::patch('update-password', [RoleBasedController::class, 'updatePassword'])->name('rolebased.updatePassword');

//2FA
Route::post('/2fa-confirm', [TwoFactorAuthController::class, 'confirm'])->name('two-factor.confirm');

//Profile urls
Route::group(['middleware' =>['auth']], function(){
    Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
});
Route::patch('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/profile/{user}/edit', [ProfileController::class, 'edit'])->name('profile.edit');

//Patient
Route::get('/profile/billing/create', [PatientController::class, 'create'])->name('patient.create');
Route::post('/profile/billing/', [PatientController::class, 'store'])->name('patient.store');
Route::delete('/profile/billing/{patient}', [PatientController::class, 'destory'])->name('patient.destory');
Route::get('/profile/billing/{patient}/edit', [PatientController::class, 'edit'])->name('patient.edit');
Route::patch('/profile/billing/update/{patient}', [PatientController::class, 'update'])->name('patient.update');
Route::get('/profile/billing/{user}', [PatientController::class, 'show'])->name('patient.show');

//Patient search for doctor's information
Route::get('/searchDocInfo', [PatientController::class, 'displayDocInfoSearch'])->name('patient.displayDocInfoSearch');
Route::any('/searchedDocInfo', [PatientController::class, 'searchDocInfo'])->name('patient.searchDocInfo');

//Added for educational material
Route::get('/educationalMenu', function(){
    return view('eduMaterials.eduMaterialsMenu');
})->middleware('role:admin')->name('eduMaterial.menu');

Route::get('/educational/create', function(){
    return view('eduMaterials.addEduMaterials');
})->middleware('role:admin')->name('eduMaterial.create');


Route::get('/addEduMaterials', [App\Http\Controllers\eduMaterialController::class, 'displayCreatePage'])->name('eduMaterial.displayCreatePage');
Route::post('/addEduMaterials', [App\Http\Controllers\eduMaterialController::class, 'store'])->name('eduMaterial.add');
Route::get('/searchEduMaterials', [App\Http\Controllers\eduMaterialController::class, 'search'])->name('eduMaterial.search');
Route::delete('/educational/delete/{edu}', [App\Http\Controllers\eduMaterialController::class, 'destroy'])->name('eduMaterial.destroy');
Route::any('/searchedEduMaterials', [App\Http\Controllers\eduMaterialController::class, 'findSearch'])->name('eduMaterial.findSearch');
Route::get('/viewEduMaterials/{id}', [App\Http\Controllers\eduMaterialController::class, 'viewShow'])->name('eduMaterial.viewShow');
Route::get('/editEduMaterials/{id}', [App\Http\Controllers\eduMaterialController::class, 'editShow'])->name('eduMaterial.editShow');
Route::patch('/editEduMaterials/{id}', [App\Http\Controllers\eduMaterialController::class, 'update'])->name('eduMaterial.update');
Route::get('/eduMaterials/admin/search', [App\Http\Controllers\eduMaterialController::class, 'index'])->name('eduMaterial.admin.search');


//Health Condition
Route::group(['middleware' =>['auth']], function(){
    Route::get('/searchHealthConditions', [ConditionController::class, 'index'])->name('searchCondition');
});
Route::group(['middleware' =>['auth']], function(){
    Route::any('/searchedHealthConditions', [ConditionController::class, 'searchResult'])->name('searchCondition.result');
});
Route::get('/searchHealthConditions/{condition}/view', [ConditionController::class, 'view'])->name('searchCondition.view');

Route::get('/addHealthConditions', function () { return view('healthConditions/addHealthConditions');})->name('addHealthConditions');
Route::get('/searchHealthConditions/{condition}/edit', [ConditionController::class, 'edit'])->name('HealthConditions.edit');
Route::patch('/searchHealthConditions/{condition}/', [ConditionController::class, 'update'])->name('HealthConditions.update');
Route::delete('/searchHealthConditions/{condition}/delete', [ConditionController::class, 'delete'])->name('deleteCondition');
Route::post('/addHealthConditions', [ConditionController::class, 'add'])->name('addHealthConditions.store');


//Email Auth
Route::get('email-auth', [EmailAuthController::class, 'index'])->name('2fa.index');
Route::post('email-auth', [EmailAuthController::class, 'store'])->name('2fa.store');
Route::get('email-auth-setVar', [EmailAuthController::class, 'setNextRoute'])->name('2fa.setVar');


//Send promotional message
Route::get('promo-menu', [SendPromoController::class, 'index'])->name('promomenu.index');
Route::get('promo-menu/create', [SendPromoController::class, 'create'])->name('promomenu.create');
Route::post('promo-menu/store', [SendPromoController::class, 'store'])->name('promomenu.store');
Route::get('promo-menu/{promomsg}', [SendPromoController::class, 'detailPromo'])->name('promomenu.detail');


//Staff available timeslot
Route::get('avail-timeslot', [AvailableTimeslotController::class, 'index'])->name('availtimeslot.index');
Route::post('avail-timeslot/store', [AvailableTimeslotController::class, 'store'])->name('availtimeslot.store');
Route::delete('avail-timeslot/delete/{at}', [AvailableTimeslotController::class, 'destory'])->name('availtimeslot.destory');
Route::any('view-all-at',[AvailableTimeslotController::class, 'viewall'])->middleware('role:admin')->name('availtimeslot.viewall');

//Admin available timeslot
Route::get('a-avail-timeslot/{ms}', [AvailableTimeslotController::class, 'aindex'])->middleware('role:admin')->name('availtimeslot.aindex');
Route::post('a-avail-timeslot/store/{ms}', [AvailableTimeslotController::class, 'astore'])->name('availtimeslot.astore');

//Book appointments (patient)
Route::get('book-appointment', [AppointmentController::class, 'index'])->middleware('role:patient')->name('bookApp.index');
Route::get('book-appointment/t', [AppointmentController::class, 'treatment'])->middleware('auth')->name('bookApp.treatment');
Route::delete('book-appointment/delete/{appointment}', [AppointmentController::class, 'destory'])->name('bookApp.destory');
Route::get('book-appointment/ms', [AppointmentController::class, 'medicalstaff'])->middleware('auth')->name('bookApp.ms');
Route::get('book-appointment/date', [AppointmentController::class, 'date'])->middleware('auth')->name('bookApp.date');
Route::get('book-appointment/view/{user}', [AppointmentController::class, 'view'])->middleware('role:patient|admin')->name('bookApp.view');
Route::get('edit-appointment/{appointment}', [AppointmentController::class, 'edit'])->middleware('role:patient|admin')->name('bookApp.edit');
Route::patch('edit-appointment/patch/{appointment}', [AppointmentController::class, 'update'])->name('bookApp.update');
Route::post('book-appointment/store', [AppointmentController::class, 'store'])->name('bookApp.store');


//Appointments (staff)
Route::get('sviewappointment/{ms}', [AppointmentController::class, 'sview'])->middleware('role:staff')->name('staffApp.view');
Route::get('seditappointment/{appointment}', [AppointmentController::class, 'sedit'])->middleware('role:staff')->name('staffApp.edit');

//Appointments (admin)
Route::get('aviewappointment', [AppointmentController::class, 'aview'])->middleware('role:admin')->name('adminApp.view');
Route::get('abook-appointment', [AppointmentController::class, 'aindex'])->middleware('role:admin')->name('abookApp.index');
Route::post('abook-appointment/store', [AppointmentController::class, 'astore'])->middleware('role:admin')->name('abookApp.store');

//create new staff account (admin)
Route::get('newstaffacc', [NewStaffAccController::class, 'index'])->middleware('role:admin')->name('adminStaffAcc.index');
Route::get('newstaffacc/dp', [NewStaffAccController::class, 'department'])->middleware('role:admin')->name('adminStaffAcc.department');
Route::get('newstaffacc/sp', [NewStaffAccController::class, 'specialty'])->middleware('role:admin')->name('adminStaffAcc.sp');
Route::post('newstaffacc/store', [NewStaffAccController::class, 'store'])->middleware('role:admin')->name('adminStaffAcc.store');

//consultation (staff)
Route::get('consult-patient', [StaffController::class, 'consult'])->name('staff.consult');
Route::get('consult-patient/getAppRec', [StaffController::class, 'getAppRec'])->name('staff.appointment');
Route::patch('consult-patient/updateStatus', [StaffController::class, 'updateStatus'])->name('staff.updateStatus');

//Payment (patient)
Route::get('view-payment/{user}',[PaymentController::class, 'index'])->name('payment.index');
Route::get('view-invoice/{app}', [PaymentController::class, 'invoice'])->name('payment.invoice');
Route::get('payment-success/{app}', [PaymentController::class, 'paymentByCard'])->name('payment.card');
Route::post('payment-cash/{app}', [PaymentController::class, 'paymentByCash'])->name('payment.cash');

//Payment (admin)
Route::get('aview-cash-payment', [PaymentController::class, 'aindex'])->middleware('role:admin')->name('apayment.index');
Route::post('apayment-approve/{paymentRec}', [PaymentController::class, 'approvePayment'])->middleware('role:admin')->name('apayment.approve');

//Feedback (patient)
Route::get('feedback/{app}', [FeedbackController::class, 'create'])->name('feedback.create');
Route::post('feedback/store', [FeedbackController::class, 'store'])->name('feedback.store');

//Feedback (admin)
Route::get('aview-feedback', [FeedbackController::class, 'aview'])->middleware('role:admin')->name('feedback.aview');
Route::get('aview-feedback/{id}', [FeedbackController::class, 'aviewComment'])->middleware('role:admin')->name('feedback.aviewComment');
Route::any('/searchedFeedback', [FeedbackController::class, 'searchTreatment'])->middleware('role:admin')->name('feedback.searchTreatment');
Route::get('/showTreatmentStatistics',[FeedbackController::class, 'showChart'])->middleware('role:admin')->name('feedback.showChart');


//Referal (hospital)
Route::get('/referral', [ReferralController::class, 'index'])->middleware('role:staff')->name('referral');
Route::get('/referral/hospital', [ReferralController::class, 'referralHospital'])->middleware('role:staff')->name('referral.hospital');
Route::get('/referral/hospital/memo', [ReferralController::class, 'apptMemo'])->middleware('role:staff')->name('referral.memo');
Route::post('/referral/hospital', [ReferralController::class, 'storeHospital'])->middleware('role:staff')->name('referral.submit');

//Referral (department)
Route::get('/referral/department', [ReferralController::class, 'referralDapartment'])->middleware('role:staff')->name('referral.department');
Route::get('/referral/department/sp', [ReferralController::class, 'sp'])->middleware('role:staff')->name('referral.sp');
Route::get('/referral/department/staff', [ReferralController::class, 'medicalStaff'])->middleware('role:staff')->name('referral.staff');
Route::get('/referral/department/date', [ReferralController::class, 'availDate'])->middleware('role:staff')->name('referral.date');
Route::get('/referral/department/time', [ReferralController::class, 'availTime'])->middleware('role:staff')->name('referral.time');
Route::get('/referral/department/memo', [ReferralController::class, 'apptMemo'])->middleware('role:staff')->name('referral.dMemo');
Route::post('/referral/department', [ReferralController::class, 'storeDepartment'])->middleware('role:staff')->name('referral.dsubmit');

//Referral
Route::post('/viewReferral/accept/{referral}', [ReferralController::class, 'accept'])->middleware('role:staff')->name('referral.accept');
Route::post('/viewReferral/reject/{referral}', [ReferralController::class, 'reject'])->middleware('role:staff')->name('referral.reject');
Route::group(['middleware' =>['auth']], function(){
    Route::get('/viewReferral', [ReferralController::class, 'view'])->name('referral.view');
});
Route::get('/viewReferral/print/{referral}', [ReferralController::class, 'print'])->middleware('role:patient')->name('referral.print');


//create medical records (staff)
Route::get('/addMedCert', [medicalRecordController::class, 'createMedCert'])->middleware('role:staff')->name('addMedCert');

Route::get('/addTestResults', [medicalRecordController::class, 'createTestResults'])->middleware('role:staff')->name('addTestResults');

Route::middleware(['role:staff'])->group(function ()
{
    Route::get('/addMedicalRecords', [App\Http\Controllers\medicalRecordController::class, 'displayCreatePage'])->name('medicalRecords.displayCreatePage');
    Route::post('/addMedCert', [App\Http\Controllers\medicalRecordController::class, 'storeMedCert'])->name('medicalRecords.storeMedCert');
    Route::post('/addPrescription', [App\Http\Controllers\medicalRecordController::class, 'storePrescription'])->name('medicalRecords.storePrescription');
    Route::post('/addTestResults', [App\Http\Controllers\medicalRecordController::class, 'storeTestResults'])->name('medicalRecords.storeTestResult');
    Route::get('/addPrescription', [App\Http\Controllers\medicalRecordController::class, 'displayPrescription'])->name('medicalRecords.displayPrescription');

    Route::delete('/viewMoreMedicalRecords/deleteCert/{record}', [App\Http\Controllers\medicalRecordController::class, 'destroyCert'])->name('medicalRecords.destroyCert');
    Route::delete('/viewMoreMedicalRecords/deleteTestResult/{record}', [App\Http\Controllers\medicalRecordController::class, 'destroyTestResult'])->name('medicalRecords.destroyTestResult');
    Route::delete('/viewMoreMedicalRecords/deletePrescription', [App\Http\Controllers\medicalRecordController::class, 'destroyPrescription'])->name('medicalRecords.destroyPrescription');

    Route::get('/editMedCert/{medcert}', [App\Http\Controllers\medicalRecordController::class, 'editCert'])->name('medicalRecords.editCert');
    Route::get('/editTestResult/{testresult}', [App\Http\Controllers\medicalRecordController::class, 'editTestResult'])->name('medicalRecords.editTestResult');
    Route::get('/editPrescription/{prescription}', [App\Http\Controllers\medicalRecordController::class, 'editPrescription'])->name('medicalRecords.editPrescription');
    Route::patch('/editMedCert/{id}', [App\Http\Controllers\medicalRecordController::class, 'updateCert'])->name('medicalRecords.updateCert');
    Route::patch('/editTestResult/{id}', [App\Http\Controllers\medicalRecordController::class, 'updateTestResult'])->name('medicalRecords.updateTestResult');
    Route::patch('/editPrescription/{id}', [App\Http\Controllers\medicalRecordController::class, 'updatePrescription'])->name('medicalRecords.updatePrescription');
});

//Patients view medical records (JunWei)
Route::middleware(['role:staff|patient'])->group(function ()
{
    Route::get('/viewMedicalRecords', [App\Http\Controllers\medicalRecordController::class, 'viewMedicalRecords'])->name('medicalRecords.viewMedicalRecords');
    Route::get('/viewMoreMedicalRecords/{id}', [App\Http\Controllers\medicalRecordController::class, 'viewMoreMedicalRecords'])->name('medicalRecords.viewMoreMedicalRecords');
    Route::get('/printMC/{id}', [App\Http\Controllers\medicalRecordController::class, 'viewMedicalCert'])->name('medicalRecords.viewMedicalCert');

});

//Common services (staff:Doctor)
Route::middleware(['role:doctor'])->group(function (){
    Route::get('bookCommonService', [commonServiceController::class, 'index'])->name('commonservices.index');
    Route::get('getNursescs', [commonServiceController::class, 'getNursecs'])->name('commonservices.getNurse');
    Route::get('getDatescs', [commonServiceController::class, 'getDatecs'])->name('commonservices.getDate');
    Route::get('getTimecs', [commonServiceController::class, 'getTimecs'])->name('commonservices.getTime');
    Route::post('bookCommonService/store', [commonServiceController::class, 'store'])->name('commonservices.store');
});

//Admin view accounts
Route::get('/viewAccounts', [AdminController::class, 'index'])->middleware('role:admin')->name('viewAccounts.view');
Route::post('/viewAccounts/suspend/{user}', [AdminController::class, 'suspendAcc'])->middleware('role:admin')->name('viewAccounts.suspend');
Route::post('/viewAccounts/unsuspend/{user}', [AdminController::class, 'unsuspendAcc'])->middleware('role:admin')->name('viewAccounts.unsuspend');


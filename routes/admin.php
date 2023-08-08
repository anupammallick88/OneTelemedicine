<?php

use App\Http\Controllers\Admin\CurrencyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\EarningsController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\UsersController;


Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('register', [RegisterController::class, 'register']);

Route::get('password/forget', function () {
    return view('pages.forgot-password');
})->name('password.forget');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email')->middleware('isDemo');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update')->middleware('isDemo');

Route::get('/logout', [LoginController::class, 'logout']);
Route::get('/clear-cache', [HomeController::class, 'clearCache']);

Route::middleware(['auth'])->group(function () {
    Route::get('/addslot', 'Doctor\DoctorSlotController@index')->name('slot.index');
    Route::post('/addslot/store', 'Doctor\DoctorSlotController@store')->name('slot.store')->middleware('isDemo');
    Route::get('/addslot/doctor/slot', 'Doctor\DoctorSlotController@adddoctortoslot')->name('slot.add');
    Route::post('/addslot/doctor/slot/create', 'Doctor\DoctorSlotController@createdoctorslot')->name('slot.create')->middleware('isDemo');
    Route::get('/addslot/doctor/{id}/delete', 'Doctor\DoctorSlotController@deletedoctorslot')->name('doctor.slot.delete')->middleware('isDemo');
    Route::get('/addslot/doctor/slot/{id}/edit', 'Doctor\DoctorSlotController@editslot')->name('slot.edit');
    Route::get('/addslot/doctor/slot/{id}/delete', 'Doctor\DoctorSlotController@deleteslot')->name('slot.delete')->middleware('isDemo');
    Route::post('/addslot/doctor/slot/{id}/edit', 'Doctor\DoctorSlotController@updateslot')->name('slot.update')->middleware('isDemo');

    Route::group(['as' => 'admin.'], function () {
        Route::group(['prefix' => 'user'], function () {
            Route::get('/', [UsersController::class, 'index'])->name('user.index');
            Route::get('create', [UsersController::class, 'create'])->name('user.create');
            Route::post('store', [UsersController::class, 'store'])->name('user.store')->middleware('isDemo');
        });

        Route::group(['prefix' => 'role'], function () {
            Route::get('/', [RoleController::class, 'index'])->name('role.index');
            Route::get('/create', [RoleController::class, 'create'])->name('role.create');
            Route::post('/store', [RoleController::class, 'store'])->name('role.store');
            Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
            Route::post('/update/{id}', [RoleController::class, 'update'])->name('role.update')->middleware('isDemo');
            Route::get('/delete/{id}', [RoleController::class, 'delete'])->name('role.delete')->middleware('isDemo');
        });
    });
    //Start:: Currency Settings
    Route::group(['prefix' => 'currency', 'as' => 'currency.'], function () {
        Route::get('/', [CurrencyController::class, 'index'])->name('index');
        Route::get('create', [CurrencyController::class, 'create'])->name('create');
        Route::post('store', [CurrencyController::class, 'store'])->name('store');
        Route::get('edit/{id}', [CurrencyController::class, 'edit'])->name('edit');
        Route::patch('update/{id}', [CurrencyController::class, 'update'])->name('update');
        Route::get('delete/{id}', [CurrencyController::class, 'delete'])->name('delete');
    });

    Route::get('/user/{user}/show', 'UsersController@show')->name('user.show');
    Route::get('/user/{user}/delete', 'UsersController@delete')->name('user.delete')->middleware('isDemo');
    Route::post('/user/{user}/update', 'UsersController@update')->name('user.update')->middleware('isDemo');

    Route::get('admin/{user}/profile', 'Admin\AdminProfileController@index')->name('admin.profile');
    Route::post('admin/{user}/profile/update', 'Admin\AdminProfileController@update')->name('admin.update')->middleware('isDemo');

    Route::get('/doctor', 'Doctor\DoctorsController@index')->name('doctor.index');
    Route::get('/doctor/create', 'Doctor\DoctorsController@create')->name('doctor.create');
    Route::post('/doctor/store', 'Doctor\DoctorsController@store')->name('doctor.store')->middleware('isDemo');
    Route::get('/doctor/{user}/show', 'Doctor\DoctorsController@show')->name('doctor.show');
    Route::post('/doctor/{user}/update', 'Doctor\DoctorsController@update')->name('doctor.update')->middleware('isDemo');

    Route::get('/doctor/{user}/status', 'Doctor\DoctorsController@status_update')->name('doctor.status');
    Route::get('/doctor/{user}/approve', 'Doctor\DoctorsController@approve_update')->name('doctor.approve');
    // Route::get('/download/{id}', 'Doctor\DoctorsController@getDownload')->name('download');

    Route::get('/languages', 'Admin\LanguageController@index')->name('language.index');
    Route::post('/language/store', 'Admin\LanguageController@store')->name('language.store')->middleware('isDemo');
    Route::get('/language/edit/{id}', 'Admin\LanguageController@edit')->name('language.edit');
    Route::get('/language/delete/{id}', 'Admin\LanguageController@delete')->name('language.delete');
    Route::post('/language/update/{id}', 'Admin\LanguageController@update')->name('language.update')->middleware('isDemo');
    Route::get('/language/translate/{id}', 'Admin\LanguageController@translate')->name('language.translate');
    Route::post('/language/translate/update/{id}', 'Admin\LanguageController@translate_update')->name('language.translate.update');

    Route::get('/appointment', 'Appointment\AppointmentController@index')->name('appointment.index');
    Route::get('/payment-to-doctor/{appointment_id}', 'Appointment\AppointmentController@paymentToDoctor')->name('appointment.payment-to-doctor');
    Route::get('/appointment/{appointment}/delete', 'Appointment\AppointmentController@delete')->name('appointment.delete')->middleware('isDemo');
    Route::get('/appointment/details/{id}', 'Appointment\AppointmentController@details')->name('appointment.details');
    Route::get('/appointment/approve/{id}', 'Appointment\AppointmentController@app_approve')->name('appointment.approve')->middleware('isDemo');

    Route::get('/patient', 'Patient\PatientController@index')->name('patient.index');
    Route::get('/patient/create', 'Patient\PatientController@create')->name('patient.create');
    Route::post('/patient/store', 'Patient\PatientController@store')->name('patient.store')->middleware('isDemo');
    Route::get('/patient/{user}/show', 'Patient\PatientController@show')->name('patient.show');
    Route::post('/patient/{user}/update', 'Patient\PatientController@update')->name('patient.update')->middleware('isDemo');

    Route::get('/category', 'Doctor\CategoryController@index')->name('doctor.category.index');
    Route::get('/category/create', 'Doctor\CategoryController@create')->name('doctor.category.create');
    Route::get('/category/{category}/show', 'Doctor\CategoryController@show')->name('doctor.category.show');
    Route::post('/category/create', 'Doctor\CategoryController@store')->name('doctor.category.store')->middleware('isDemo');
    Route::post('/category/{category}/update', 'Doctor\CategoryController@update')->name('doctor.category.update')->middleware('isDemo');
    Route::get('/category/{category}/delete', 'Doctor\CategoryController@delete')->name('doctor.category.delete')->middleware('isDemo');

    Route::get('/dashboard', 'Admin\DashboardController@index')->name('dashboard');

    Route::get('/site/create', 'Admin\SiteIdentityController@create')->name('sites.create');
    Route::post('/site/store', 'Admin\SiteIdentityController@store')->name('sites.store')->middleware('isDemo');
    Route::post('/site/update', 'Admin\SiteIdentityController@update')->name('sites.update')->middleware('isDemo');

    Route::get('/subscriber', 'SubscriberController@index')->name('subscribers.index');
    Route::get('/subscriber/sendmail', 'SubscriberController@sendMail')->name('subscribers.mail');
    Route::post('/subscriber/sendmail', 'SubscriberController@sendMailToAll')->name('subscribers.mailsent')->middleware('isDemo');

    Route::get('/smtp', 'Admin\SmtpController@index')->name('smtp.index');
    Route::post('/smtpupdate', 'Admin\SmtpController@update')->name('smtp.update')->middleware('isDemo');

    Route::get('/zoom-setting', 'Admin\SmtpController@zoom_setting')->name('zoom.setting.index');
    Route::post('/zoom-setitng-update', 'Admin\SmtpController@zoom_setting_update')->name('zoom.setting.update')->middleware('isDemo');

    Route::get('/paymentmethod', 'Admin\PaymentMethodSettingController@index')->name('paymentmethod.index');
    Route::post('/paymentmethodupdate', 'Admin\PaymentMethodSettingController@update')->name('paymentmethod.update')->middleware('isDemo');

    Route::get('/earnings', [EarningsController::class, 'earningList'])->name('earnings.index');
    Route::get('/spotpayment', [EarningsController::class, 'spotpayment'])->name('spotpayment.index');
    Route::get('/earnings-details/{id}', [EarningsController::class, 'doctorPayDetails'])->name('earnings.details');
    Route::post('/add-payment-online-doctor/{doc_id}', [EarningsController::class, 'addPaymentOnlineDoctor'])->name('earnings.add-payment')->middleware('isDemo');
});

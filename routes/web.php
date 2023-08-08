<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\Auth\DoctorRegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('/filterdoctor/{category}/{slot}', 'Doctor\FilterDoctorController@filterdoctor');
Route::get('/filterdoctor/doctor/{docid}/{slot}', 'Doctor\FilterDoctorController@filterdoctorById');
Route::post('/checkappointment', 'Doctor\FilterDoctorController@checkappointment');

Route::post('/subscriber', 'SubscriberController@store')->name('subscriber.store');
Route::group(['middleware' => 'auth'], function () {


	Route::get('/approve/{appointment}/appointment', 'Doctor\AppointmentController@approve')->name('approve')->middleware('isDemo');
	Route::get('/complete/{appointment}/appointment', 'Doctor\AppointmentController@complete')->name('complete');
	Route::get('/remove/{appointment}/appointment', 'Doctor\AppointmentController@delete')->name('removeapp')->middleware('isDemo');


	Route::get('/payment', 'Front\PaymentController@index')->name('paypalhome');
	Route::post('/payment/pay', 'Front\PaymentController@pay')->name('pay')->middleware('isDemo');
	Route::post('/payment/pay-offline', 'Front\PaymentController@payOffline')->name('payOffline')->middleware('isDemo');
	Route::get('/payment/approval', 'Front\PaymentController@approval')->name('approval');
	Route::get('/payment/cancelled', 'Front\PaymentController@cancelled')->name('cancelled');


	Route::post('searchappointment', 'Front\SearchAppointmentController@search');
	Route::post('patientappointment', 'Front\SearchAppointmentController@patientsearch');
	Route::post('searchappointmentdate', 'Front\SearchAppointmentController@searchdate');
	Route::post('doctorsearchappointmentdate', 'Front\SearchAppointmentController@doctorsearchdate');

	Route::get('pagination/fetch_data', 'Front\HomeController@fetch_data');
	Route::get('pagination/todays_fetch_data', 'Front\HomeController@todays_fetch_data');
	Route::get('pagination/dashboard_fetch_data', 'Front\HomeController@dashboard_fetch_data');
	Route::post('set-payment-type', 'Front\HomeController@setPaymentType')->name('patient.set_payment_type');

	Route::get('pagination/doctor_fetch_data', 'Front\HomeController@doctor_fetch_data');
	Route::get('pagination/doctor_todays_fetch_data', 'Front\HomeController@doctor_todays_fetch_data');
	Route::get('pagination/doctor_dashboard_fetch_data', 'Front\HomeController@doctor_dashboard_fetch_data');

	Route::post('/appointment', 'Front\AppointmentController@appointment')->name('appointment')->middleware('isDemo');
	Route::get('/appointment-delete/{appointment}', 'Front\AppointmentController@deleteappointment')->name('delete.appointment')->middleware('isDemo');
	Route::post('/appointment-cancel/{appointment_id}', 'Front\AppointmentController@cancelAppointment')->name('cancel.appointment')->middleware('isDemo');

	ROute::post('/userprofile/{user}', 'Front\UserProfileController@update')->name('user.profile')->middleware('isDemo');

	Route::get('/patient-dashboard', 'Front\HomeController@index')->name('patient.dashboard');
	Route::get('/patient-dashboard-redirect/{doctorselected}', 'Front\HomeController@redirect')->name('patient.dashboard.redirect')->middleware('doctorpermission');
	Route::get('/doctor-dashboard', 'Front\HomeController@doctorindex')->name('doctor.dashboard');
	Route::post('/doctor-zoom-create-link', 'Front\HomeController@doctorZoomCreateLink')->name('doctor.zoom_create_link')->middleware('isDemo');
	Route::get('/financial-report', 'Front\HomeController@financialReport')->name('doctor.financialReport');

	Route::post('/doctor/{appointment}/prescription', 'Front\PrescriptionController@prescription')->name('prescription')->middleware('isDemo');
	Route::post('/prescription/{appointment}', 'Front\PrescriptionController@update')->name('prescription.update')->middleware('isDemo');
	Route::get('/pdfdownoad/{app}', 'Front\PrescriptionController@pdf')->name('pdfdownload');
	Route::get('/printpres/{app}', 'Front\PrescriptionController@printpres')->name('printpres');
});


Route::get('/signup', 'Front\SigninSignupController@signup')->name('patient.signup');
Route::get('/doctor-signup', 'Front\SigninSignupController@doctorsignup')->name('doctor.signup');
Route::get('/forgetpassword', 'Front\SigninSignupController@forgetpassword')->name('forgetpassword');
Route::post('/forgetpasswordpost', 'Front\SigninSignupController@forgetpasswordpost')->name('forget-pass')->middleware('isDemo');
Route::get('/resetpassword/{token}', 'Front\SigninSignupController@resetpassword')->name('resetpassword');
Route::post('/resetpassword/{token}', 'Front\SigninSignupController@resetpasswordpost')->name('resetpasswordpost')->middleware('isDemo');
Route::get('/appointment-receipt/{appointment_id}', [\App\Http\Controllers\Front\HomeController::class, 'appointmentReceipt'])->name('appointment.receipt');


Route::post('/signup', [RegisterController::class, 'register'])->name('user.create');
Route::get('/signin', 'Front\SigninSignupController@signin')->name('signin');
Route::post('/doctor-signup', [DoctorRegisterController::class, 'register'])->name('doctor.register');


Route::post('/stripe', 'Front\StripeController@index');

Route::get('update', 'InstallController@updateView')->name('update_view');
//Route::get('update-version', 'InstallController@updateVersion')->name('update_version');
Route::post('install-application', 'InstallController@finalizeInstall')->name('update_application');

Route::get('logout', function () {
	Auth::logout();
	return redirect()->route('front.index');
})->name('logout');

// SSLCOMMERZ Start
Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

// paypal start
Route::get('paypal', array('as' => 'status', 'uses' => 'PaypalController@getPaymentStatus',));
// paypal end

// stripe start
Route::get('/stripe', [StripeController::class, 'index']);
Route::post('/transaction', [StripeController::class, 'makePayment'])->name('make-payment');
//stripe end

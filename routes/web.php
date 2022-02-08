<?php

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

/**
 * WELCOME PAGE - SITE OPENING PAGE
 */
Route::get('/', function () {
    return view('welcome');
});
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
});

	/**
	 * USER AUTHENTICATION ROUTES
	 */

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');  //User Home Page.

Route::resource('student/application','ApplicationController'); //student application part


//Year wise Hostel Managemnet For Warden
Route::resource('FirstYear','FirstYearController'); 
Route::resource('SecondYear','SecondYearController'); 
Route::resource('ThirdYear','ThirdYearController'); 
Route::resource('FourthYear','FourthYearController'); 


Route::post('HostelAccomodation/Form','FormController@form')->name('getapplicationform'); //form hostel-wise
//download application pdf
Route::get('/applicationpdf/{regno}','FormController@applicationpdf')->name('applicationpdf'); 

	/**
 	 * admin authentication
 	 
	 Route::POST('admin','Admin\LoginController@login');
	                                                                                                                                                                
	 Route::GET('admin','Admin\LoginController@showLoginForm')->name('admin.login');

	 Route::GET('admin/register','Admin\LoginController@showRegistrationForm')->name('admin.register');
	                                                                                                                                                                                                                                                                                                                              
	 Route::POST('admin-password/email','Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
	                                                                                                                                                                
	 Route::POST('admin-password/reset','Admin\ResetPasswordController@reset');                                                                
	 Route::GET('admin-password/reset','Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
	                                                                                                                                                                
	 Route::GET('admin-password/reset/{token}','Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
	*/

	 
	 /*
	  * ADMIN PAGES
	  */
	 
//SORTING ALGORITHMS and  hostel rooms CRUD of hostels
Route::resource('hostel/allotment','AllotmentController');
Route::get('hostel/result/{id}', 'AllotmentController@result')->name('result');

//result
Route::get('hostel/accomodation/result/{year}', 'AllotmentController@allotment')->name('allotment');

//hostel CRUD
Route::resource('/hostels','HostelController');

//SETTINGS
Route::resource('allotment/settings','HostelmanageController');

//Capacity planiing year wise seats available
Route::resource('accomodation/capacitysettings','CapacityController');

// alloting hostels yearwise
Route::resource('ait/managehostels','HostelplanningController');
Route::post('ait/hostelallot', 'HostelplanningController@hostelallot')->name('hostelalloted');

//Dashboard for each hostel
Route::get('hostel/dashboard/{id}', 'HostelmanageController@dashboard')->name('hosteldashboard');

//Dashboard for ROOM CRUD OF each hostel
Route::get('ait/boyshostel/{id}', 'HostelmanageController@managerooms')->name('boyshostel');



// USER DATA provided
Route::resource('hostel/student/info','UserdetailController'); 
//user data controller
 Route::GET('/userregistration','UserdetailController@userregistration');
// User Account Verification Email with token
 Route::GET('/verify/{token}','UserdetailController@verifyuser');
Route::post('Studentdetailimport', 'UserdetailController@importuserdetails')->name('userdetailsimport');
 

// Student Merit function
Route::resource('student/merit','StudentmeritController'); 
Route::post('meritimport', 'StudentmeritController@importstudentmerit')->name('meritimport');

//Result in excel
Route::get('hostel/allotment/excelresult/{year}', 'AllotmentController@allotmentexcel')->name('allotmentexcel');

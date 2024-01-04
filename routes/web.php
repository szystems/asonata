<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\InscriptionsController;

//admin
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InstructorController;
use App\Http\Controllers\Admin\AtletaController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\CycleController;
use App\Http\Controllers\Admin\InscriptionAdminController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\AssistController;
use App\Http\Controllers\Admin\InstructorClassesController;
use App\Http\Controllers\Admin\ConfigController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

//Web Page Views
Route::get('/', [FrontendController::class, 'index']);
Route::get('about-us', [FrontendController::class, 'aboutus']);
Route::get('contact', [FrontendController::class, 'contact']);
Route::get('send-contact-email', [FrontendController::class, 'sendcontactemail']);

Route::get('queries', [FrontendController::class, 'queries']);
Route::get('query-inscription', [FrontendController::class, 'queryinscription']);
Route::get('query-payments', [FrontendController::class, 'querypayments']);

Route::get('inscriptions-cycles', [InscriptionsController::class, 'inscriptionscyles']);
Route::get('inscriptions-classes/{id}', [InscriptionsController::class, 'inscriptionsclasses']);
Route::get('show-inscription-class/{id}', [InscriptionsController::class, 'showinscriptionclass']);
Route::get('inscription-submit','Frontend\InscriptionsController@inscriptionathlete');
Route::match(['get','post'],'new-athlete-inscription','Frontend\InscriptionsController@insertathlete');
Route::match(['get','post'],'update-athlete-inscription/{id}', [InscriptionsController::class, 'updateathlete']);
Route::get('pdf-inscription', 'Frontend\InscriptionsController@pdf');
Route::get('pdf-inscription-payments', 'Frontend\FrontendController@pdfinscriptionpayments');


Auth::routes();

//language
Route::get('/set_language/{lang}', [App\Http\Controllers\Controller::class, 'set_language'])->name('set_language');

Route::middleware(['auth'])->group(function () {
    //front user
});

//Admin Dashboard
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard','Admin\FrontendController@index');

    //Alert Payments
    Route::get('pdf-alert-payments', 'Admin\FrontendController@pdfalertpayments');
    Route::get('pdf-alert-assists', 'Admin\FrontendController@pdfassistsalert');
    Route::get('pdf-alert-assists-instructor', 'Admin\FrontendController@pdfassistsalertinstructor');

    //Admin Users
    Route::get('users', [DashboardController::class, 'users']);
    Route::get('show-user/{id}', [DashboardController::class, 'showuser']);
    Route::get('add-user', 'Admin\DashboardController@adduser');
    Route::post('insert-user','Admin\DashboardController@insertuser');
    Route::get('edit-user/{id}',[DashboardController::class,'edituser']);
    Route::put('update-user/{id}', [DashboardController::class, 'updateuser']);
    Route::get('delete-user/{id}', [DashboardController::class, 'destroyuser']);
    Route::get('pdf-user', 'Admin\DashboardController@pdf');

    //Admin Athletes
    Route::get('index_athletes', [AtletaController::class, 'index']);
    Route::get('show-athlete/{id}', [AtletaController::class, 'show']);
    Route::get('add-athlete', 'Admin\AtletaController@add');
    Route::post('insert-athlete','Admin\AtletaController@insert');
    Route::get('edit-athlete/{id}',[AtletaController::class,'edit']);
    Route::put('update-athlete/{id}', [AtletaController::class, 'update']);
    Route::get('delete-athlete/{id}', [AtletaController::class, 'destroy']);
    Route::get('pdf-athlete', 'Admin\AtletaController@pdf');

    //Admin Classes
    Route::get('index_cycle_classes', [ClassController::class, 'indexcycles']);
    Route::get('index_classes/{id}', [ClassController::class, 'indexclasses']);
    Route::get('add-class/{id}', [ClassController::class, 'addclass']);
    Route::post('insert-class','Admin\ClassController@insertclass');
    Route::get('edit-class/{id}',[ClassController::class,'editclass']);
    Route::put('update-class/{id}', [ClassController::class, 'updateclass']);
    Route::get('show-class/{id}', [ClassController::class, 'showclass']);
    Route::get('delete-class/{id}', [ClassController::class, 'destroyclass']);

    //Admin Assists
    Route::get('add-assist/{id}', [ClassController::class, 'addassist']);
    Route::post('insert-assist','Admin\ClassController@insertassist');
    Route::get('edit-assist/{id}',[ClassController::class,'editassist']);
    Route::put('update-assist/{id}', [ClassController::class, 'updateassist']);
    Route::get('show-assist/{id}', [ClassController::class, 'showassist']);
    Route::get('delete-assist/{id}', [ClassController::class, 'destroyassist']);

    //Admin Reporte asistencias
    Route::get('index_asistencias', [AssistController::class, 'index']);
    Route::get('pdf-assists', 'Admin\AssistController@pdf');

    //Admin Facilities
    Route::get('index_facilities', [FacilityController::class, 'index']);
    Route::get('show-facility/{id}', [FacilityController::class, 'show']);
    Route::get('add-facility', 'Admin\FacilityController@add');
    Route::post('insert-facility','Admin\FacilityController@insert');
    Route::get('edit-facility/{id}',[FacilityController::class,'edit']);
    Route::put('update-facility/{id}', [FacilityController::class, 'update']);
    Route::get('delete-facility/{id}', [FacilityController::class, 'destroy']);

    //Admin Group
    Route::get('index_groups', [GroupController::class, 'index']);
    Route::get('show-group/{id}', [GroupController::class, 'show']);
    Route::get('add-group', 'Admin\GroupController@add');
    Route::post('insert-group','Admin\GroupController@insert');
    Route::get('edit-group/{id}',[GroupController::class,'edit']);
    Route::put('update-group/{id}', [GroupController::class, 'update']);
    Route::get('delete-group/{id}', [GroupController::class, 'destroy']);

    //Admin category
    Route::get('add-category/{id}',[GroupController::class,'addcategory']);
    Route::post('insert-category','Admin\GroupController@insertcategory');
    Route::get('edit-category/{id}',[GroupController::class,'editcategory']);
    Route::put('update-category/{id}', [GroupController::class, 'updatecategory']);
    Route::get('show-category/{id}', [GroupController::class, 'showcategory']);
    Route::get('delete-category/{id}', [GroupController::class, 'destroycategory']);

    //Admin Cycles
    Route::get('index_cycles', [CycleController::class, 'index']);
    Route::get('show-cycle/{id}', [CycleController::class, 'show']);
    Route::get('add-cycle', 'Admin\CycleController@add');
    Route::post('insert-cycle','Admin\CycleController@insert');
    Route::get('edit-cycle/{id}',[CycleController::class,'edit']);
    Route::put('update-cycle/{id}', [CycleController::class, 'update']);
    Route::get('delete-cycle/{id}', [CycleController::class, 'destroy']);

    //Admin Schedule
    Route::get('add-schedule/{id}',[CycleController::class,'addschedule']);
    Route::post('insert-schedule','Admin\CycleController@insertschedule');
    Route::get('edit-schedule/{id}',[CycleController::class,'editschedule']);
    Route::put('update-schedule/{id}', [CycleController::class, 'updateschedule']);
    Route::get('show-schedule/{id}', [CycleController::class, 'showschedule']);
    Route::get('delete-schedule/{id}', [CycleController::class, 'destroyschedule']);

    //Instructor Users
    Route::get('instructores', [InstructorController::class, 'users']);
    Route::get('show-instructor/{id}', [InstructorController::class, 'showuser']);
    Route::get('add-instructor', 'Admin\InstructorController@adduser');
    Route::post('insert-instructor','Admin\InstructorController@insertuser');
    Route::get('edit-instructor/{id}',[InstructorController::class,'edituser']);
    Route::put('update-instructor/{id}', [InstructorController::class, 'updateuser']);
    Route::get('delete-instructor/{id}', [InstructorController::class, 'destroyuser']);
    Route::get('pdf-instructor', 'Admin\InstructorController@pdf');

    //Inscriptions
    Route::get('inscriptions', [InscriptionAdminController::class, 'inscriptions']);
    Route::get('show-inscription/{id}', [InscriptionAdminController::class, 'showinscription']);
    Route::get('add-inscription', 'Admin\InscriptionAdminController@addinscription');
    Route::post('insert-inscription','Admin\InscriptionAdminController@insertinscription');
    Route::get('edit-inscription/{id}',[InscriptionAdminController::class,'editinscription']);
    Route::put('update-inscription/{id}', [InscriptionAdminController::class, 'updateinscription']);
    Route::get('delete-inscription/{id}', [InscriptionAdminController::class, 'destroyinscription']);
    Route::put('update-class_inscription', [InscriptionAdminController::class, 'updateclassinscription']);

    //Admin Payments
    Route::get('index_payments', [PaymentController::class, 'index']);
    Route::get('show-payment/{id}', [PaymentController::class, 'show']);
    Route::get('pdf-payments', 'Admin\PaymentController@pdf');
    Route::post('add-payment', 'Admin\PaymentController@addpayment');
    Route::get('pdf-payment', 'Admin\PaymentController@pdfpayment');
    Route::get('export', [PaymentController::class, 'export']);
    Route::put('delete-payment/{id}', [PaymentController::class, 'destroy']);

    //Instructor Classes
    Route::get('my-classes', [InstructorClassesController::class, 'index']);
    Route::get('my-classes/{id}', [InstructorClassesController::class, 'showclass']);

    //config
    Route::get('config', [ConfigController::class, 'index']);
    Route::put('update-config', [ConfigController::class, 'update']);


 });

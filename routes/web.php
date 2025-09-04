<?php

use App\Events\SenddDoctorNotificationEvent;
use App\Events\SendNotificationEvent;
use App\Http\Controllers\Admin\Admin\AdminController;
use App\Http\Controllers\Admin\Appointments\AppointmentController;
use App\Http\Controllers\Admin\Articles\ArticaleController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Banners\BannerController;
use App\Http\Controllers\Admin\Branches\BranchController;
use App\Http\Controllers\Admin\Categories\CategoriesController;
use App\Http\Controllers\Admin\Cities\CitiesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Doctors\DoctorController;
use App\Http\Controllers\Admin\DrugUsers\DrugUsersController;
use App\Http\Controllers\Admin\MedicalTest\MedicalTestController;
use App\Http\Controllers\Admin\MedicalTestsUsers\MedicalTestUserController;
use App\Http\Controllers\Admin\Notifications\NotiticationController;
use App\Http\Controllers\Admin\Profile\ProfileController;
use App\Http\Controllers\Admin\Roles\RoleController;
use App\Http\Controllers\Admin\Services\ServicController;
use App\Http\Controllers\Admin\Settings\PageSettingController;
use App\Http\Controllers\Admin\Settings\SettingController;
use App\Http\Controllers\Admin\Specializations\SpecializationController;
use App\Http\Controllers\Admin\SurgicalOperations\SurgicalOperationController;
use App\Http\Controllers\Admin\Users\UserController;
use App\Http\Controllers\Admin\Videoes\VideoController;
use App\Http\Controllers\Front\IndexController;
use App\Models\Admin;
use App\Notifications\AdminSpecificNotification;
use App\Notifications\DoctorAlert;
use App\Notifications\DoctorNotification;
use App\Notifications\NewOrderNotification;
use App\Notifications\TicketUpdatedNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


// Route::get('/', function () {
//     return view('front.layouts.master');
// });
Route::get('/check-admin', function () {
    return Auth::guard('admin')->check()
        ? '✅ Admin logged in'
        : '❌ Not logged in';
});

Route::get('/send-alert', function () {
    $doctor = Admin::find(3); // ID الدكتور

    $doctor->notify(new DoctorAlert("لديك موعد جديد مع مريض"));
});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::group(
            [
                'prefix' => 'admin', // تأكد من التهجئة هنا
            ],
            function () {
                Route::group(
                    [
                        'prefix' => 'auth', // تأكد من التهجئة هنا
                        'middleware' => 'guest'
                    ],
                    function () {
                        Route::get('login', [LoginController::class, 'getLogin'])->name('login');

                        Route::get('login', [LoginController::class, 'getLogin'])->name('admin.login');
                        Route::post('post_login', [LoginController::class, 'postLogin'])->name('admin.login.post');
                    }
                );

                Route::group(
                    ['middleware' => 'auth:admin',],
                    function () {
                        Route::get('/', [DashboardController::class, 'index'])->name('admin.index');
                        Route::get('/invoice_chart', [DashboardController::class, 'invoicesChart'])->name('admin.invoices.chart');



                        Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');
                    }
                );


                Route::group(['prefix' => 'my-profile'], function () {
                    Route::get('/', [ProfileController::class, 'getProfile'])->name('admin.profile.index');
                    Route::post('/profile', [ProfileController::class, 'Profile'])->name('admin.profile.profile');
                    Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('admin.profile.changePassword');
                });

                Route::group(
                    ['prefix' => 'admins'],
                    function () {
                        Route::get('/', [AdminController::class, 'index'])->name('admin.admins.index')->middleware('can:view_admin');
                        Route::get('/get_index', [AdminController::class, 'getIndex'])->name('admin.admins.getIndex')->middleware('can:view_admin');
                        Route::get('/create', [AdminController::class, 'create'])
                            ->name('admin.admins.create')
                            ->middleware('can:add_admin');
                        Route::get('/edit/{id}', [AdminController::class, 'edit'])
                            ->name('admin.admins.edit')
                            ->middleware('can:edit_admin');
                        Route::post('/update', [AdminController::class, 'update'])
                            ->name('admin.admins.update')
                            ->middleware('can:edit_admin');
                        Route::post('/store', [AdminController::class, 'store'])
                            ->name('admin.admins.store')
                            ->middleware('can:add_admin');
                        Route::post('/delete', [AdminController::class, 'delete'])
                            ->name('admin.admins.delete')
                            ->middleware('can:delete_admin');
                        Route::post('/update_status', [AdminController::class, 'updateStatus'])
                            ->name('admin.admins.updateStatus')
                            ->middleware('can:update_status_admin');
                        Route::get('/export_pdf', [AdminController::class, 'exportPdf'])
                            ->name('admin.admins.exportPdf')
                            ->middleware('can:export_pdf_admin');
                        Route::get('/export_excel', [AdminController::class, 'exportExcel'])
                            ->name('admin.admins.exportExcel')
                            ->middleware('can:export_excel_admin');
                    }
                );
                Route::group(
                    ['prefix' => 'roles'],
                    function () {
                        Route::get('/', [RoleController::class, 'index'])
                            ->name('admin.roles.index')
                            ->middleware('can:view_roles');
                        Route::get('/getIndex', [RoleController::class, 'getIndex'])
                            ->name('admin.roles.getIndex')
                            ->middleware('can:view_roles');
                        Route::get('/create', [RoleController::class, 'create'])
                            ->name('admin.roles.create')
                            ->middleware('can:add_roles');
                        Route::post('/store', [RoleController::class, 'store'])
                            ->name('admin.roles.store')
                            ->middleware('can:add_roles');
                        Route::get('/edit/{id}', [RoleController::class, 'edit'])
                            ->name('admin.roles.edit')
                            ->middleware('can:edit_roles');
                        Route::post('/update', [RoleController::class, 'update'])
                            ->name('admin.roles.update')
                            ->middleware('can:edit_roles');
                        Route::post('/updateStatus', [RoleController::class, 'updateStatus'])
                            ->name('admin.roles.updateStatus')
                            ->middleware('can:update_status_roles');
                        Route::post('/delete', [RoleController::class, 'delete'])
                            ->name('admin.roles.delete')
                            ->middleware('can:delete_roles');
                    }
                );



                Route::group(['prefix' => 'branches'], function () {
                    Route::get('/', [BranchController::class, 'index'])->name('admin.branches.index')->middleware('can:view_branch');
                    Route::get('/getIndex', [BranchController::class, 'getIndex'])->name('admin.branches.getIndex')->middleware('can:view_branch');
                    Route::post('/store', [BranchController::class, 'store'])->name('admin.branches.store')->middleware('can:view_branch');

                    Route::post('/update', [BranchController::class, 'update'])->name('admin.branches.update')->middleware('can:view_branch');
                    Route::post('/updateStatus', [BranchController::class, 'updateStatus'])->name('admin.branches.updateStatus')->middleware('can:view_branch');
                    Route::post('/delete', [BranchController::class, 'delete'])->name('admin.branches.delete')->middleware('can:view_branch');
                    Route::get('/pdfExport', [BranchController::class, 'pdfExport'])->name('admin.branches.pdfExport')->middleware('can:view_branch');
                    Route::get('/excelExport', [BranchController::class, 'excelExport'])->name('admin.branches.excelExport')->middleware('can:view_branch');
                });

                Route::group(['prefix' => 'services'], function () {
                    Route::get('/', [ServicController::class, 'index'])->name('admin.services.index')->middleware('can:view_service');
                    Route::get('/getIndex', [ServicController::class, 'getIndex'])->name('admin.services.getIndex')->middleware('can:view_service');
                    Route::post('/store', [ServicController::class, 'store'])->name('admin.services.store')->middleware('can:add_service');

                    Route::post('/update', [ServicController::class, 'update'])->name('admin.services.update')->middleware('can:edit_service');
                    Route::post('/updateStatus', [ServicController::class, 'updateStatus'])->name('admin.services.updateStatus')->middleware('can:update_status_service');
                    Route::post('/delete', [ServicController::class, 'delete'])->name('admin.services.delete')->middleware('can:delete_service');
                });

                Route::group(['prefix' => 'specializations'], function () {
                    Route::get('/', [SpecializationController::class, 'index'])->name('admin.specializations.index')->middleware('can:view_specialization');
                    Route::get('/getIndex', [SpecializationController::class, 'getIndex'])->name('admin.specializations.getIndex')->middleware('can:view_specialization');
                    Route::post('/store', [SpecializationController::class, 'store'])->name('admin.specializations.store')->middleware('can:add_specialization');
                    Route::post('/update', [SpecializationController::class, 'update'])->name('admin.specializations.update')->middleware('can:edit_specialization');
                    Route::post('/updateStatus', [SpecializationController::class, 'updateStatus'])->name('admin.specializations.updateStatus')->middleware('can:update_status_specialization');
                    Route::post('/delete', [SpecializationController::class, 'delete'])->name('admin.specializations.delete')->middleware('can:delete_specialization');
                });

                Route::group(['prefix' => 'banners'], function () {
                    Route::get('/', [BannerController::class, 'index'])->name('admin.banners.index')->middleware('can:view_banner');
                    Route::get('/getIndex', [BannerController::class, 'getIndex'])->name('admin.banners.getIndex')->middleware('can:view_banner');
                    Route::post('/store', [BannerController::class, 'store'])->name('admin.banners.store')->middleware('can:view_banner');
                    Route::post('/update', [BannerController::class, 'update'])->name('admin.banners.update')->middleware('can:view_banner');
                    Route::post('/updateStatus', [BannerController::class, 'updateStatus'])->name('admin.banners.updateStatus')->middleware('can:update_status_banner');
                    Route::post('/delete', [BannerController::class, 'delete'])->name('admin.banners.delete')->middleware('can:view_banner');
                });


                Route::group(['prefix' => 'articale'], function () {
                    Route::get('/', [ArticaleController::class, 'index'])->name('admin.articales.index')->middleware('can:view_articale');
                    Route::get('/getIndex', [ArticaleController::class, 'getIndex'])->name('admin.articales.getIndex')->middleware('can:view_articale');
                    Route::post('/store', [ArticaleController::class, 'store'])->name('admin.articales.store')->middleware('can:add_articale');
                    Route::post('/update', [ArticaleController::class, 'update'])->name('admin.articales.update')->middleware('can:edit_articale');
                    Route::post('/updateStatus', [ArticaleController::class, 'updateStatus'])->name('admin.articales.updateStatus')->middleware('can:update_status_articale');
                    Route::post('/delete', [ArticaleController::class, 'delete'])->name('admin.articales.delete')->middleware('can:delete_articale');
                });
                Route::group(['prefix' => 'videos'], function () {
                    Route::get('/', [VideoController::class, 'index'])->name('admin.videos.index')->middleware('can:view_video');
                    Route::get('/getIndex', [VideoController::class, 'getIndex'])->name('admin.videos.getIndex')->middleware('can:view_video');
                    Route::post('/store', [VideoController::class, 'store'])->name('admin.videos.store')->middleware('can:add_video');
                    Route::post('/update', [VideoController::class, 'update'])->name('admin.videos.update')->middleware('can:edit_video');
                    Route::post('/updateStatus', [VideoController::class, 'updateStatus'])->name('admin.videos.updateStatus')->middleware('can:update_status_video');
                    Route::post('/delete', [VideoController::class, 'delete'])->name('admin.videos.delete')->middleware('can:delete_video');
                });









                Route::group(['prefix' => 'cities'], function () {
                    Route::get('/', [CitiesController::class, 'index'])->name('admin.settings.cities.index')->middleware('can:view_city');
                    Route::get('/getIndex', [CitiesController::class, 'getIndex'])->name('admin.settings.cities.getIndex')->middleware('can:view_city');
                    Route::post('/store', [CitiesController::class, 'store'])->name('admin.settings.cities.store')->middleware('can:add_city');
                    Route::post('/update', [CitiesController::class, 'update'])->name('admin.settings.cities.update')->middleware('can:edit_city');
                    Route::post('/updateStatus', [CitiesController::class, 'updateStatus'])->name('admin.settings.cities.updateStatus')->middleware('can:update_status_city');
                    Route::post('/delete', [CitiesController::class, 'delete'])->name('admin.settings.cities.delete')->middleware('can:delete_city');
                });

                Route::group(['prefix' => 'settings'], function () {

                    Route::get('/', [SettingController::class, 'index'])->name('admin.settings.index')->middleware('can:view_setting');
                    Route::post('/update', [SettingController::class, 'update'])->name('admin.settings.update');
                    Route::get('/page', [PageSettingController::class, 'index'])->name('admin.pages.index')->middleware('can:view_setting');
                    Route::post('/update_page', [PageSettingController::class, 'update'])->name('admin.settings.updatePages');
                    Route::get('/work-hours', [PageSettingController::class, 'getWorkHours'])->name('admin.settings.getWorkHours');

                    Route::post('/update_work_hours', [PageSettingController::class, 'WorkHours'])->name('admin.settings.WorkHours');
                });

                Route::group(['prefix' => 'medical_tests'], function () {
                    Route::get('/', [MedicalTestController::class, 'index'])->name('admin.medicalTests.index')->middleware('can:view_medical_test');
                    Route::get('/getIndex', [MedicalTestController::class, 'getIndex'])->name('admin.medicalTests.getIndex')->middleware('can:view_medical_test');
                    Route::post('/store', [MedicalTestController::class, 'store'])->name('admin.medicalTests.store')->middleware('can:add_medical_test');
                    Route::post('/update', [MedicalTestController::class, 'update'])->name('admin.medicalTests.update')->middleware('can:edit_medical_test');
                    Route::post('/updateStatus', [MedicalTestController::class, 'updateStatus'])->name('admin.medicalTests.updateStatus')->middleware('can:update_status_medical_test');
                    Route::post('/delete', [MedicalTestController::class, 'delete'])->name('admin.medicalTests.delete')->middleware('can:delete_medical_test');
                });


                Route::group(['prefix' => 'user_medical_test'], function () {
                    Route::get('/', [MedicalTestUserController::class, 'index'])->name('admin.medicalTestUsers.index')->middleware('can:view_medical_test');
                    Route::get('/getIndex', [MedicalTestUserController::class, 'getIndex'])->name('admin.medicalTestUsers.getIndex')->middleware('can:view_medical_test');
                    Route::post('/store', [MedicalTestUserController::class, 'store'])->name('admin.medicalTestUsers.store')->middleware('can:add_medical_test');
                    Route::post('/update', [MedicalTestUserController::class, 'update'])->name('admin.medicalTestUsers.update')->middleware('can:edit_medical_test');
                    Route::post('/updateStatus', [MedicalTestUserController::class, 'updateStatus'])->name('admin.medicalTestUsers.updateStatus')->middleware('can:update_status_city');
                    Route::post('/delete', [MedicalTestUserController::class, 'delete'])->name('admin.medicalTestUsers.delete')->middleware('can:delete_medical_test');
                });


                Route::group(['prefix' => 'drug-users'], function () {
                    Route::get('/', [DrugUsersController::class, 'index'])->name('admin.drugUsers.index')->middleware('can:view_medical_test');
                    Route::get('/getIndex', [DrugUsersController::class, 'getIndex'])->name('admin.drugUsers.getIndex')->middleware('can:view_medical_test');
                    Route::post('/store', [DrugUsersController::class, 'store'])->name('admin.drugUsers.store')->middleware('can:add_medical_test');
                    Route::post('/update', [DrugUsersController::class, 'update'])->name('admin.drugUsers.update')->middleware('can:edit_medical_test');
                    Route::post('/updateStatus', [DrugUsersController::class, 'updateStatus'])->name('admin.drugUsers.updateStatus')->middleware('can:update_status_city');
                    Route::post('/delete', [DrugUsersController::class, 'delete'])->name('admin.drugUsers.delete')->middleware('can:delete_medical_test');
                });

                Route::group(['prefix' => 'categories'], function () {
                    Route::get('/', [CategoriesController::class, 'index'])->name('admin.categories.index')->middleware('can:view_category');
                    Route::get('/getIndex', [CategoriesController::class, 'getIndex'])->name('admin.categories.getIndex')->middleware('can:view_category');
                    Route::get('/create', [CategoriesController::class, 'create'])->name('admin.categories.create')->middleware('can:add_category');
                    Route::post('/store', [CategoriesController::class, 'store'])->name('admin.categories.store')->middleware('can:add_category');
                    Route::get('/edit/{id}', [CategoriesController::class, 'edit'])->name('admin.categories.edit')->middleware('can:edit_category');

                    Route::post('/update', [CategoriesController::class, 'update'])->name('admin.categories.update')->middleware('can:edit_category');
                    Route::post('/updateStatus', [CategoriesController::class, 'updateStatus'])->name('admin.categories.updateStatus')->middleware('can:update_status_category');
                    Route::post('/delete', [CategoriesController::class, 'delete'])->name('admin.categories.delete')->middleware('can:delete_category');
                    Route::post('before-surgical-upload', [CategoriesController::class, 'uploadBeforeSurgical'])->name('admin.categories.before_surgical_upload');
                    Route::post('before-surgical-delete', [CategoriesController::class, 'deleteBeforeSurgical'])->name('admin.categories.before_surgical_delete');

                    Route::post('after-surgical-upload', [CategoriesController::class, 'uploadAfterSurgical'])->name('admin.categories.after_surgical_upload');
                    Route::post('after-surgical-delete', [CategoriesController::class, 'deleteAfterSurgical'])->name('admin.categories.after_surgical_delete');
                });




                Route::group(['prefix' => 'users'], function () {
                    Route::get('/', [UserController::class, 'index'])->name('admin.users.index')->middleware('can:view_user');
                    Route::get('/getIndex', [UserController::class, 'getIndex'])->name('admin.users.getIndex')->middleware('can:view_user');
                    Route::get('/create', [UserController::class, 'create'])->name('admin.users.create')->middleware('can:add_user');
                    Route::get('/view/{id}', [UserController::class, 'view'])->name('admin.users.view')->middleware('can:view_user');

                    Route::post('/store', [UserController::class, 'store'])->name('admin.users.store')->middleware('can:add_user');
                    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('admin.users.edit')->middleware('can:edit_user');

                    Route::post('/update', [UserController::class, 'update'])->name('admin.users.update')->middleware('can:edit_user');
                    Route::post('/updateStatus', [UserController::class, 'updateStatus'])->name('admin.users.updateStatus')->middleware('can:update_status_user');
                    Route::post('/delete', [UserController::class, 'delete'])->name('admin.users.delete')->middleware('can:delete_user');
                });



                Route::group(['prefix' => 'doctors'], function () {
                    Route::get('/', [DoctorController::class, 'index'])->name('admin.doctors.index')->middleware('can:view_doctor');
                    Route::get('/getIndex', [DoctorController::class, 'getIndex'])->name('admin.doctors.getIndex')->middleware('can:view_doctor');
                    Route::get('/create', [DoctorController::class, 'create'])->name('admin.doctors.create')->middleware('can:add_doctor');
                    Route::post('/store', [DoctorController::class, 'store'])->name('admin.doctors.store')->middleware('can:add_doctor');
                    Route::get('/edit/{id}', [DoctorController::class, 'edit'])->name('admin.doctors.edit')->middleware('can:edit_doctor');
                    Route::post('/update', [DoctorController::class, 'update'])->name('admin.doctors.update')->middleware('can:edit_doctor');
                    Route::post('/updateStatus', [DoctorController::class, 'updateStatus'])->name('admin.doctors.updateStatus')->middleware('can:update_status_doctor');
                    Route::post('/delete', [DoctorController::class, 'delete'])->name('admin.doctors.delete')->middleware('can:delete_doctor');

                    Route::get('/doctor/branches', [DoctorController::class, 'getBranches'])->name('admin.doctors.getBranches');
                    Route::get('/doctor/available-days', [DoctorController::class, 'getAvailableDays'])->name('admin.doctors.getAvailableDays');

                    Route::get('/doctor/available-times', [DoctorController::class, 'getAvailableTimes'])->name('admin.doctors.getAvailableTimes');
                });



                Route::group(['prefix' => 'appointments'], function () {

                    Route::get('/', [AppointmentController::class, 'index'])->name('admin.appointments.index')->middleware('can:view_appointment');
                    Route::get('/getIndex', [AppointmentController::class, 'getIndex'])->name('admin.appointments.getIndex')->middleware('can:view_appointment');

                    Route::post('/store', [AppointmentController::class, 'store'])->name('admin.appointments.store')->middleware('can:add_appointment');
                    Route::post('/update', [AppointmentController::class, 'update'])->name('admin.appointments.update')->middleware('can:edit_appointment');
                    Route::post('/delete', [AppointmentController::class, 'delete'])->name('admin.appointments.delete')->middleware('can:delete_appointment');
                    Route::get('/getDoctor', [AppointmentController::class, 'getDoctors'])->name('admin.appointments.getDoctors')->middleware('can:view_appointment');
                });


                Route::group(['prefix' => 'surgical_operation'], function () {

                    Route::get('/', [SurgicalOperationController::class, 'index'])->name('admin.surgicalOperations.index')->middleware('can:view_surgical_operation');
                    Route::get('/getIndex', [SurgicalOperationController::class, 'getIndex'])->name('admin.surgicalOperations.getIndex')->middleware('can:view_surgical_operation');

                    Route::post('/store', [SurgicalOperationController::class, 'store'])->name('admin.surgicalOperations.store')->middleware('can:add_surgical_operation');
                    Route::post('/update', [SurgicalOperationController::class, 'update'])->name('admin.surgicalOperations.update')->middleware('can:edit_surgical_operation');
                    Route::post('/delete', [SurgicalOperationController::class, 'delete'])->name('admin.surgicalOperations.delete')->middleware('can:delete_surgical_operation');
                });

                Route::group(['prefix' => 'notifciations'], function () {
                    Route::get('/create', [NotiticationController::class, 'index'])->name('admin.notifciations.create')->middleware('can:view_video');
                    Route::post('/create', [NotiticationController::class, 'store'])->name('admin.notifications.store')->middleware('can:view_video');
                });
            }
        );


        Route::get('/', [IndexController::class, 'index'])->name('home');
        Route::get('/appointment', [IndexController::class, 'appointment'])->name('appointment');


    }
);

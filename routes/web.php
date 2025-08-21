<?php

use App\Http\Controllers\Admin\Admin\AdminController;
use App\Http\Controllers\Admin\Articles\ArticaleController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Banners\BannerController;
use App\Http\Controllers\Admin\Branches\BranchController;
use App\Http\Controllers\Admin\Cities\CitiesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Doctors\DoctorController;
use App\Http\Controllers\Admin\MedicalTest\MedicalTestController;
use App\Http\Controllers\Admin\Profile\ProfileController;
use App\Http\Controllers\Admin\Roles\RoleController;
use App\Http\Controllers\Admin\Services\ServicController;
use App\Http\Controllers\Admin\Settings\SettingController;
use App\Http\Controllers\Admin\Specializations\SpecializationController;
use App\Http\Controllers\Admin\Videoes\VideoController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::get('/', function () {
    return view('welcome');
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
                    Route::get('/', [BranchController::class, 'index'])->name('admin.branches.index');
                    Route::get('/getIndex', [BranchController::class, 'getIndex'])->name('admin.branches.getIndex');
                    Route::post('/store', [BranchController::class, 'store'])->name('admin.branches.store');

                    Route::post('/update', [BranchController::class, 'update'])->name('admin.branches.update');
                    Route::post('/updateStatus', [BranchController::class, 'updateStatus'])->name('admin.branches.updateStatus');
                    Route::post('/delete', [BranchController::class, 'delete'])->name('admin.branches.delete');
                    Route::get('/pdfExport', [BranchController::class, 'pdfExport'])->name('admin.branches.pdfExport');
                    Route::get('/excelExport', [BranchController::class, 'excelExport'])->name('admin.branches.excelExport');
                });

                Route::group(['prefix' => 'services'], function () {
                    Route::get('/', [ServicController::class, 'index'])->name('admin.services.index');
                    Route::get('/getIndex', [ServicController::class, 'getIndex'])->name('admin.services.getIndex');
                    Route::post('/store', [ServicController::class, 'store'])->name('admin.services.store');

                    Route::post('/update', [ServicController::class, 'update'])->name('admin.services.update');
                    Route::post('/updateStatus', [ServicController::class, 'updateStatus'])->name('admin.services.updateStatus');
                    Route::post('/delete', [ServicController::class, 'delete'])->name('admin.services.delete');
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


                Route::group(['prefix' => 'doctors'], function () {
                    Route::get('/', [DoctorController::class, 'index'])->name('admin.doctors.index')->middleware('can:view_articale');
                    Route::get('/getIndex', [DoctorController::class, 'getIndex'])->name('admin.doctors.getIndex')->middleware('can:view_articale');
                    Route::get('/create', [DoctorController::class, 'create'])->name('admin.doctors.create')->middleware('can:view_articale');
                    Route::post('/store', [DoctorController::class, 'store'])->name('admin.doctors.store')->middleware('can:add_articale');
                     Route::get('/edit/{id}', [DoctorController::class, 'edit'])->name('admin.doctors.edit')->middleware('can:view_articale');
                    Route::post('/update', [DoctorController::class, 'update'])->name('admin.doctors.update')->middleware('can:edit_articale');
                    Route::post('/updateStatus', [DoctorController::class, 'updateStatus'])->name('admin.doctors.updateStatus')->middleware('can:update_status_articale');
                    Route::post('/delete', [DoctorController::class, 'delete'])->name('admin.doctors.delete')->middleware('can:delete_articale');
                });




        Route::group(['prefix' => 'medical_tests'], function () {
                    Route::get('/', [MedicalTestController::class, 'index'])->name('admin.medicalTests.index')->middleware('can:view_city');
                    Route::get('/getIndex', [MedicalTestController::class, 'getIndex'])->name('admin.medicalTests.getIndex')->middleware('can:view_city');
                    Route::post('/store', [MedicalTestController::class, 'store'])->name('admin.medicalTests.store')->middleware('can:add_city');
                    Route::post('/update', [MedicalTestController::class, 'update'])->name('admin.medicalTests.update')->middleware('can:edit_city');
                    Route::post('/updateStatus', [MedicalTestController::class, 'updateStatus'])->name('admin.medicalTests.updateStatus')->middleware('can:update_status_city');
                    Route::post('/delete', [MedicalTestController::class, 'delete'])->name('admin.medicalTests.delete')->middleware('can:delete_city');
                });


                Route::group(['prefix' => 'cities'], function () {
                    Route::get('/', [CitiesController::class, 'index'])->name('admin.settings.cities.index')->middleware('can:view_city');
                    Route::get('/getIndex', [CitiesController::class, 'getIndex'])->name('admin.settings.cities.getIndex')->middleware('can:view_city');
                    Route::post('/store', [CitiesController::class, 'store'])->name('admin.settings.cities.store')->middleware('can:add_city');
                    Route::post('/update', [CitiesController::class, 'update'])->name('admin.settings.cities.update')->middleware('can:edit_city');
                    Route::post('/updateStatus', [CitiesController::class, 'updateStatus'])->name('admin.settings.cities.updateStatus')->middleware('can:update_status_city');
                    Route::post('/delete', [CitiesController::class, 'delete'])->name('admin.settings.cities.delete')->middleware('can:delete_city');
                });


                Route::group(['prefix' => 'videos'], function () {
                    Route::get('/', [VideoController::class, 'index'])->name('admin.videos.index')->middleware('can:view_video');
                    Route::get('/getIndex', [VideoController::class, 'getIndex'])->name('admin.videos.getIndex')->middleware('can:view_video');
                    Route::post('/store', [VideoController::class, 'store'])->name('admin.videos.store')->middleware('can:add_video');
                    Route::post('/update', [VideoController::class, 'update'])->name('admin.videos.update')->middleware('can:edit_video');
                    Route::post('/updateStatus', [VideoController::class, 'updateStatus'])->name('admin.videos.updateStatus')->middleware('can:update_status_video');
                    Route::post('/delete', [VideoController::class, 'delete'])->name('admin.videos.delete')->middleware('can:delete_video');
                });
                Route::group(['prefix' => 'settings'], function () {

                    Route::get('/', [SettingController::class, 'index'])->name('admin.settings.index');
                    Route::post('/update', [SettingController::class, 'update'])->name('admin.settings.update');
                });
            }
        );
    }
);

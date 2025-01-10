<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ItaController;
use App\Http\Controllers\PatientServiceController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\MHealthSubstancesController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::get('/home', function () {
//     return Inertia::render('Fontend/Home/Home');
// });
Route::get('/', [HomeController::class, 'Home'])->name('Home');

Route::name('News.')->prefix('News')->group(function () {
    Route::get('/PressRelease/{type_news}', [NewsController::class, 'Press_Release'])->name('Press_Release');
    Route::get('/NewsPurchase/{type_news}', [NewsController::class, 'News_purchase'])->name('News_purchase');
    Route::get('/PressRelease/detail/{id}', [NewsController::class, 'Press_Release_detail'])->name('Press_Release_detail');
});

Route::name('InterestingInformation.')->prefix('InterestingInformation')->group(function () {
    Route::get('/InterestingInformation/{type_InterestingInformation}', [MHealthSubstancesController::class, 'InterestingInformation'])->name('InterestingInformation');
    Route::get('/InterestingInformation/detail/{id}', [MHealthSubstancesController::class, 'InterestingInformation_detail'])->name('InterestingInformation_detail');
});

Route::name('Ita.')->prefix('Ita')->group(function () {
    Route::get('/index', [ItaController::class, 'Ita_index'])->name('Ita_index');
});

Route::name('PatientService.')->prefix('PatientService')->group(function () {
    Route::get('/DoctorTable/index', [PatientServiceController::class, 'DoctorTable_index'])->name('DoctorTable_index');
    Route::get('/PatientRoom/index', [PatientServiceController::class, 'PatientRoom_index'])->name('PatientRoom_index');
    Route::get('/TreatmentForm/index', [PatientServiceController::class, 'TreatmentForm_index'])->name('TreatmentForm_index');
});

Route::get('/dashboard', function () {
    return Inertia::render('Admin/Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::name('Manage.')->prefix('Manage')->group(function () {

        // ----------- จัดการข่าว
        Route::get('/MNews', [NewsController::class, 'MNews'])->name('MNews');
        Route::get('/MNews/create', [NewsController::class, 'MNews_create'])->name('MNews_create');
        Route::post('/MNews/create/insert', [NewsController::class, 'MNews_create_insert'])->name('MNews_create_insert');
        Route::get('/MNews/move/bin/{id}', [NewsController::class, 'MNews_move_bin'])->name('MNews_move_bin');
        Route::get('/MNews/edit/{id}', [NewsController::class, 'MNews_edit'])->name('MNews_edit');
        Route::post('/MNews/edit/update', [NewsController::class, 'MNews_edit_update'])->name('MNews_edit_update');

        // ----------- จัดการบริการสำหรับผู้ป่วย
        Route::get('/ManagePatientService/MDoctorTable', [PatientServiceController::class, 'MDoctorTable'])->name('MDoctorTable');
        Route::get('/ManagePatientService/MDoctorTable/create', [PatientServiceController::class, 'MDoctorTable_create'])->name('MDoctorTable_create');
        Route::post('/ManagePatientService/MDoctorTable/create/insert', [PatientServiceController::class, 'MDoctorTable_create_insert'])->name('MDoctorTable_create_insert');
        Route::post('/ManagePatientService/MDoctorTable/sub/create/insert', [PatientServiceController::class, 'MDoctorTable_sub_create_insert'])->name('MDoctorTable_sub_create_insert');
        Route::post('/ManagePatientService/MDoctorTable/edit', [PatientServiceController::class, 'MDoctorTable_edit'])->name('MDoctorTable_edit');
        Route::post('/ManagePatientService/MDoctorTable/delete', [PatientServiceController::class, 'MDoctorTable_delete'])->name('MDoctorTable_delete');
        Route::get('/ManagePatientService/MDoctorTable/detail/{id}', [PatientServiceController::class, 'MDoctorTable_detail'])->name('MDoctorTable_detail');
        Route::post('/ManagePatientService/MDoctorTable/sub/edit', [PatientServiceController::class, 'MDoctorTable_sub_edit'])->name('MDoctorTable_sub_edit');
        Route::post('/ManagePatientService/MDoctorTable/sub/delete', [PatientServiceController::class, 'MDoctorTable_sub_delete'])->name('MDoctorTable_sub_delete');

        Route::get('/ManagePatientService/MPatientRoom', [PatientServiceController::class, 'MPatientRoom'])->name('MPatientRoom');
        Route::post('/ManagePatientService/MPatientRoom/insert', [PatientServiceController::class, 'MPatientRoom_insert'])->name('MPatientRoom_insert');
        Route::post('/ManagePatientService/MPatientRoom/edit', [PatientServiceController::class, 'MPatientRoom_edit'])->name('MPatientRoom_edit');
        Route::post('/ManagePatientService/MPatientRoom/delete', [PatientServiceController::class, 'MPatientRoom_delete'])->name('MPatientRoom_delete');
        Route::post('/ManagePatientService/MPatientRoom/price/insert', [PatientServiceController::class, 'MPatientRoom_price_insert'])->name('MPatientRoom_price_insert');
        Route::post('/ManagePatientService/MPatientRoom/title/edit', [PatientServiceController::class, 'MPatientRoom_title_edit'])->name('MPatientRoom_title_edit');
        Route::post('/ManagePatientService/MPatientRoom/price/edit', [PatientServiceController::class, 'MPatientRoom_price_edit'])->name('MPatientRoom_price_edit');
        Route::post('/ManagePatientService/MPatientRoom/addres/edit', [PatientServiceController::class, 'MPatientRoom_address_edit'])->name('MPatientRoom_address_edit');
        Route::post('/ManagePatientService/MPatientRoom/addres/delete', [PatientServiceController::class, 'MPatientRoom_address_delete'])->name('MPatientRoom_address_delete');
        Route::post('/ManagePatientService/MPatientRoom/addres/add', [PatientServiceController::class, 'MPatientRoom_address_add'])->name('MPatientRoom_address_add');
        Route::post('/ManagePatientService/MPatientRoom/all/delete', [PatientServiceController::class, 'MPatientRoom_all_delete'])->name('MPatientRoom_all_delete');

        Route::get('/ManagePatientService/MTreatmentForm', [PatientServiceController::class, 'MTreatmentForm'])->name('MTreatmentForm');
        Route::post('/ManagePatientService/MTreatmentForm/update', [PatientServiceController::class, 'MTreatmentFormUpdate'])->name('MTreatmentFormUpdate');

        // ----------- จัดการข้อมูลที่น่าสนใจ
        Route::get('/MHealthSubstances', [MHealthSubstancesController::class, 'MHealthSubstances'])->name('MHealthSubstances');
        Route::get('/MHealthSubstances/create', [MHealthSubstancesController::class, 'MHealthSubstances_create'])->name('MHealthSubstances_create');
        Route::post('/MHealthSubstances/create/insert', [MHealthSubstancesController::class, 'MHealthSubstances_create_insert'])->name('MHealthSubstances_create_insert');
        Route::get('/MHealthSubstances/move/bin/{id}', [MHealthSubstancesController::class, 'MHealthSubstances_move_bin'])->name('MHealthSubstances_move_bin');
        Route::get('/MHealthSubstances/edit/{id}', [MHealthSubstancesController::class, 'MHealthSubstances_edit'])->name('MHealthSubstances_edit');
        Route::post('/MHealthSubstances/edit/update', [MHealthSubstancesController::class, 'MHealthSubstances_edit_update'])->name('MHealthSubstances_edit_update');

        // ----------- จัดการ ITA
        Route::get('/MIta', [ItaController::class, 'MIta'])->name('MIta');
        Route::get('/MIta/create', [ItaController::class, 'MIta_create'])->name('MIta_create');
        Route::post('/MIta/create/insert', [ItaController::class, 'MIta_create_insert'])->name('MIta_create_insert');
        Route::post('/MIta/sub/create/insert', [ItaController::class, 'MIta_sub_create_insert'])->name('MIta_sub_create_insert');
        Route::post('/MIta/edit', [ItaController::class, 'MIta_edit'])->name('MIta_edit');
        Route::post('/MIta/delete', [ItaController::class, 'MIta_delete'])->name('MIta_delete');
        Route::get('/MIta/detail/{id}', [ItaController::class, 'MIta_detail'])->name('MIta_detail');
        Route::post('/MIta/sub/edit', [ItaController::class, 'MIta_sub_edit'])->name('MIta_sub_edit');
        Route::post('/MIta/sub/delete', [ItaController::class, 'MIta_sub_delete'])->name('MIta_sub_delete');

        // Route::get('/MPatientService/index', [PatientServiceController::class, 'MDoctorTable_index'])->name('MPatientService_index');

        Route::get('/MGeneral', [GeneralController::class, 'MGeneral'])->name('MGeneral');
        Route::post('/MGeneral/edit', [GeneralController::class, 'MGeneral_edit'])->name('MGeneral_edit');
        Route::post('/MGeneral/banner/create', [GeneralController::class, 'MGeneral_banner_create'])->name('MGeneral_banner_create');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

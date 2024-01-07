<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\GameProviderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReqWedeController;
use App\Http\Controllers\ClosingController;



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



Route::get('/', function () {
    return view('home', [ 
        'link' => '/',
        'title' => 'Module Withdrawal'
    ]);
});

Route::post('/user',[UserController::class, 'store']);
Route::get('/settings/users', [ UserController::class, 'show' ] );
Route::get('/settings/user/{user:uuid}/edit', [ UserController::class, 'edit' ] );
Route::get('/settings/user/{user:uuid}/delete', [ UserController::class, 'delete' ] );
Route::put('/settings/user/{user:uuid}/update', [ UserController::class, 'update' ] )->name('user.update');
Route::get('/settings/user/{user:uuid}', [UserController::class, 'view'])->name('settings.user');

/* 
| Jangan Lupa Tambahkan Validasi pada Input 
| untuk mengecek double input
| berdasarkan tanggal, menit, userid dan jumlahwd
*/
Route::get('/cs/input-reqwd', [ TransactionsController::class, 'input' ] );
Route::post('/cs/input-reqwd/create', [ TransactionsController::class, 'store' ] );


/*
Update Request Withdrawal hanya bisa dilakukan untuk transaksi dengan status open
sebelum diload ke frontend, akan melakukan update pada record dengan mengubah status menjadi edit
setelah selesai melakukan update ataupun user batal melakukan update, 
maka status diubah kembali menjadi open
*/
// Route::get('/cs/update-reqwd', [ TransactionsController::class, 'update' ] );



/*
Grab Request Withdrawal dilakukan oleh Tim Finance
sesuai dengan batasan maksimum yang sudah ditentukan setiap usernya
*/
Route::get('/fin/grab-reqwd', [ TransactionsController::class, 'start' ] );
Route::post('/fin/grab-reqwd', [ TransactionsController::class, 'grab' ] );
Route::get('/fin/list-grabwd', [ TransactionsController::class, 'list' ] );
Route::get('/fin/show-grabwd/{uuid}', [ TransactionsController::class, 'show' ] );
Route::post('/fin/process-grabwd/{uuid}', [ TransactionsController::class, 'process' ] );
Route::post('/fin/cancel-grabwd/{uuid}', [ TransactionsController::class, 'cancel' ] );
Route::post('/fin/pending-grabwd/{uuid}', [ TransactionsController::class, 'pending' ] );
Route::post('/fin/reject-grabwd/{uuid}', [ TransactionsController::class, 'reject' ] );

Route::get('/fin/notif',[ReportsController::class, 'notif']);
Route::get('/fin/notif/grab',[ReportsController::class, 'notifgrab']);



Route::post('/fin/updatepending/{uuid}', [ TransactionsController::class, 'updatepending' ] );
Route::post('/fin/rejectpending/{uuid}', [ TransactionsController::class, 'rejectpending' ] );


Route::get('/reports/statuswd', [ ReportsController::class, 'statuswd' ] );
Route::get('/reports/statuswd/{uuid}', [ ReportsController::class, 'detailwd' ] );
Route::get('reports/historycs', [ ReportsController::class, 'historycs' ] );
Route::get('reports/hariancs/{reqid}', [ ReportsController::class, 'hariancs' ] );


Route::get('/reports/list-wd-open', [ ReportsController::class, 'listwdopen' ] );
Route::get('/reports/list-wd-process', [ ReportsController::class, 'listwdprocess' ] );
Route::get('/reports/list-wd-pending', [ ReportsController::class, 'listwdpending' ] );
// Route::get('/reports/list-wd-success', [ ReportsController::class, 'listwdsuccess' ] );
Route::get('/reports/list-wd-success-all', [ ReportsController::class, 'listwdsuccessall' ] );
Route::get('/reports/list-wd-reject', [ ReportsController::class, 'listwdreject' ] );
Route::get('/reports/list-wd-personal', [ ReportsController::class, 'listwdpersonal' ] );
Route::get('/reports/list-wd-all', [ ReportsController::class, 'listwdall' ] );

// Route::get("/reports/datapending", [ ReportsController::class, 'datalistwdpending' ] );
// Route::get("/reports/datareject", [ ReportsController::class, 'datalistwdreject' ] );




Route::get('/reports/rekap-wd-open', [ ReportsController::class, 'rekapwdopen' ] );
Route::get('/reports/rekap-wd-process', [ ReportsController::class, 'rekapwdprocess' ] );
Route::get('/reports/rekap-wd-pending', [ ReportsController::class, 'rekapwdpending' ] );
Route::get('/reports/rekap-wd-success', [ ReportsController::class, 'rekapwdsuccess' ] );
Route::get('/reports/rekap-wd-reject', [ ReportsController::class, 'rekapwdreject' ] );

Route::get('/settings/agents',[ AgentController::class, 'show']);
Route::post('/settings/agents/create',[ AgentController::class, 'create']);

Route::get('/settings/providers',[ GameProviderController::class, 'show']);
Route::post('/settings/providers/create',[ GameProviderController::class, 'create']);
Route::get('/settings/provider/{kodeprovider}',[ GameProviderController::class, 'find']);

Route::get('/settings/closing' , [ ClosingController::class, 'index' ] );
// Route::get('/settings/closing/history' , [ ClosingController::class, 'history' ] );
Route::post('/settings/closing/daily' , [ ClosingController::class, 'closeShift' ] );
Route::post('/settings/closing/delete' , [ ClosingController::class, 'deleteShift' ] );
// Route::post('/settings/closing/opendaily' , [ ClosingController::class, 'newShift' ] );
Route::get('/settings/closing/{id}/listwd', [ ReportsController::class, 'listwdclosing' ] );




Route::get('/login', [ AuthController::class, 'login' ] )->name('login')->middleware('guest');
Route::post('/login', [ AuthController::class, 'authenticate' ] );
Route::post('/logout', [ AuthController::class, 'logout' ] );



Route::resource('/cs/reqwd',ReqWedeController::class)->middleware('auth');
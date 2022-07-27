<?php

use App\Models\User;
use App\Models\Jadwal;
use App\Models\Kandang;
use App\Models\Produksi;
use App\Models\Penangkaran;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PakanController;
use App\Http\Controllers\KandangController;
use App\Http\Controllers\PanduanController;
use App\Http\Controllers\PekerjaController;
use App\Http\Controllers\PemilikController;
use App\Http\Controllers\ProduksiController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KebersihanController;
use App\Http\Controllers\PenangkaranController;
use App\Http\Controllers\HasilProduksiController;



// Route::get('/tes', function () {
//     //get relation produksis table
//     // $allProduksi = Produksi::all()->load('kandang');
//     $allProduksi = Produksi::with('kandang')->get();
//     //get all produksi not null by kandang data
//     $NotNullProduksi = [];
//     foreach ($allProduksi as $produksi) {
//         if ($produksi->kandang !== null) {
//             $NotNullProduksi[] = $produksi;
//         }
//     }
//     //collect data last produksi based on kandang
//     // $LastProduksiByKandang = collect($NotNullProduksi)->groupBy('kandang_id')->map(function ($item) {
//     //     return $item->all();
//     // });
//     //get value jadwal from
//     $JadwalProduksi = collect($NotNullProduksi)->groupBy('kandang_id')->map(function ($item) {
//         return $item;
//     });
//     //Update kategori kandang berdasarkan tanggal
//     // $UpdateKandang = $JadwalProduksi->map(function ($item) {
//     //     if ($item->tgl_akan_menetas_end < date('Y-m-d')) {
//     //         //get id kandang from $item
//     //         $item->produksi->status_produksi = 'Mati';
//     //         $item->produksi->save();
//     //         // return 'Success Get Function';
//     //     } else {
//     //         // must give a notifikasi
//     //         // return 'Tidak Update';
//     //     }
//     //     return $item;
//     // });
//     return response()->json($JadwalProduksi);
//     // return response()->json([
//     //     'message' => 'Successfully create new progress',
//     //     'JadwalProduksi' => $JadwalProduksi,
//     // ], 200);
// });
// Route::get('/tesi', function () {
//     // $allkandang = Kandang::with('kebersihans')->get();
//     // $kandangs = $allkandang->find(1);
//     // $kandang = $kandangs->kebersihans->last();
//     // $kandang->status = 'Sudah';
//     // $kandang->save();
//     // return response()->json($kandang);
//     // abort(404);
//     $produksi = Produksi::all();
//     $value = 'DLGBF-124';
//     $value2 = '';
//     // $tes = [];
//     // foreach ($produksi as $e) {
//     //     $tes[] = $e->kode_ring;
//     // }
//     // if (in_array($value, $tes)) {
//     //     return 'true';
//     // } else {
//     //     return 'false';
//     // }
//     $produksis = Produksi::where([['kode_ring', '=', $value2]])->first();
//     if ($produksis != null) {
//         return 'Betull';
//     } else {
//         return 'salah';
//     }
//     // return response()->json($produksis);
// });

Route::get('/tes', function () {

    $notif = User::find(auth()->user()->id)->notifications;
    return response()->json($notif);
});

Route::get('/pusher', function () {

    $data = [
        'user_id' => 1,
        'message' => 'TEsss'
    ];
    event(new \App\Events\NotifUser($data));
});


Route::get('/', function () {
    return view('page');
});
//auth
Route::get('/login', [LoginController::class, 'ReadLogin'])->name('login');
Route::post('/login', [LoginController::class, 'Login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'ViewRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'CreateUser'])->name('register');

// dashboard
Route::get('/dashboard', [DashboardController::class, 'ReadDashboard'])->name('dashboard');
Route::get('/dashboard/jadwal', [DashboardController::class, 'ReadDashboardJadwal']);
Route::get('/dashboard/pakan', [DashboardController::class, 'ReadDashboardPakan']);
Route::get('/dashboard/kebersihan', [DashboardController::class, 'ReadDashboardKebersihan']);


// middleware group
Route::middleware(['pemilik'])->group(function () {
    // Pengelolaan Pemilik
    Route::get('/penangkaran', [PemilikController::class, 'ReadPenangkaran'])->name('read.penangkaran');
    Route::get('/kandang', [PemilikController::class, 'ReadKandang'])->name('kandang');
    Route::get('/pakan', [PemilikController::class, 'ReadPakan'])->name('pakan');
    Route::get('/pengguna-pemilik', [PemilikController::class, 'ReadUserPemilik'])->name('pengguna.pemilik');
    Route::get('/pengguna-pekerja', [PemilikController::class, 'ReadUserPekerja'])->name('pengguna.pekerja');
    Route::get('/panduan', [PemilikController::class, 'ReadPanduan'])->name('panduan');
    // Pengguna [V]
    Route::get('/modal-read/{id}', [UserController::class, 'ModalRead']);
    Route::get('/modal-create', [UserController::class, 'ModalCreate']);
    Route::get('/modal-update/{id}', [UserController::class, 'ModalUpdate']);
    Route::get('/modal-delete/{id}', [UserController::class, 'ModalDelete']);
    Route::get('/table-pemilik', [UserController::class, 'ReadTablePemilik']);
    Route::get('/table-pekerja', [UserController::class, 'ReadTablePekerja']);
    Route::post('/pengguna', [UserController::class, 'CreateUser'])->name('create.pengguna');
    Route::patch('/pengguna/update/{id}', [UserController::class, 'UpdateUser'])->name('update.pengguna');
    Route::delete('/pengguna/delete/{id}', [UserController::class, 'DeleteUser'])->name('delete.pengguna');
    // Penangkaran [V]
    Route::get('/modal-read-penangkaran/{id}', [PenangkaranController::class, 'ModalRead']);
    Route::get('/modal-create-penangkaran', [PenangkaranController::class, 'ModalCreate']);
    Route::get('/modal-update-penangkaran/{id}', [PenangkaranController::class, 'ModalUpdate']);
    Route::get('/modal-delete-penangkaran/{id}', [PenangkaranController::class, 'ModalDelete']);
    Route::get('/show-penangkaran', [PenangkaranController::class, 'ShowPenangkaran']);
    Route::post('/penangkaran', [PenangkaranController::class, 'CreatePenangkaran'])->name('create.penangkaran');
    Route::patch('/penangkaran/update/{id}', [PenangkaranController::class, 'UpdatePenangkaran'])->name('update.penangkaran');
    Route::delete('/penangkaran/delete/{id}', [PenangkaranController::class, 'DeletePenangkaran'])->name('delete.penangkaran');
    // Kandang [X]
    Route::get('/penangkaran/{id}/lokasi/{lokasi_penangkaran}', [PenangkaranController::class, 'DetailPenangkaran'])->name('detail.penangkaran');
    Route::get('/modal-read-kandang/{id}', [KandangController::class, 'ModalRead']);
    Route::get('/modal-create-kandang/{id}', [KandangController::class, 'ModalCreate']);
    Route::get('/modal-update-kandang/{id}', [KandangController::class, 'ModalUpdate']);
    Route::get('/modal-delete-kandang/{id}', [KandangController::class, 'ModalDelete']);
    Route::get('/show-kandang/{id}', [KandangController::class, 'ShowKandang']);
    Route::post('/kandang', [KandangController::class, 'CreateKandang'])->name('create.kandang');
    Route::patch('/kandang/update/{id}', [KandangController::class, 'UpdateKandang'])->name('update.kandang');
    Route::delete('/kandang/delete/{id}', [KandangController::class, 'DeleteKandang'])->name('delete.kandang');
    // Pakan [X]
    Route::get('/modal-read-pakan/{id}', [PakanController::class, 'ModalRead']);
    Route::get('/modal-create-pakan', [PakanController::class, 'ModalCreate']);
    Route::get('/modal-delete-pakan/{id}', [PakanController::class, 'ModalDelete']);
    Route::get('/show-pakan', [PakanController::class, 'ShowPakan']);
    Route::post('/pakan', [PakanController::class, 'CreatePakan'])->name('create.pakan');
    Route::patch('/pakan/update/{id}', [PakanController::class, 'UpdateKandang'])->name('update.pakan');
    Route::delete('/pakan/delete/{id}', [PakanController::class, 'DeletePakan'])->name('delete.pakan');
    // Panduan [V]
    Route::get('/modal-read-panduan/{id}', [PanduanController::class, 'ModalRead']);
    Route::get('/modal-create-panduan', [PanduanController::class, 'ModalCreate']);
    Route::get('/modal-update-panduan/{id}', [PanduanController::class, 'ModalUpdate']);
    Route::get('/modal-delete-panduan/{id}', [PanduanController::class, 'ModalDelete']);
    Route::get('/show-panduan', [PanduanController::class, 'ShowPanduan']);
    Route::post('/panduan', [PanduanController::class, 'CreatePanduan'])->name('create.panduan');
    Route::patch('/panduan/update/{id}', [PanduanController::class, 'UpdatePanduan'])->name('update.panduan');
    Route::delete('/panduan/delete/{id}', [PanduanController::class, 'DeletePanduan'])->name('delete.panduan');
});
Route::middleware(['pekerja'])->group(function () {
    // User Pekerja
    Route::get('/detail-kandang', [PekerjaController::class, 'DetailKandang'])->name('detail.kandang');
    Route::get('/Panduan-Pekerja-Perawatan', [PekerjaController::class, 'ReadPanduan'])->name('user.panduan');
    //pakan
    Route::get('/modal-update-pakan/{id}', [PakanController::class, 'ModalUpdate']);
    Route::post('/update-pakan/{id}', [PakanController::class, 'UpdatePakan'])->name('update.pakan');
});



// Kandang for all user [X]
Route::get('/kandang/{id}/{namakandang}', [KandangController::class, 'RiwayatKandang'])->name('riwayat.kandang');

//Kebersihan [X]
Route::get('/modal-create-kebersihan/{id}', [KebersihanController::class, 'ModalCreate']);
Route::post('/kebersihan/create', [KebersihanController::class, 'CreateKebersihan'])->name('create.kebersihan');


// Read Produksi
Route::get('/modal-read-produksi/{id}', [HasilProduksiController::class, 'ModalReadProduksi']);
// Produksi [X]
Route::get('/show-produksi-inkubator', [ProduksiController::class, 'ShowProduksiInkubator']);
Route::get('/show-produksi-hidup', [ProduksiController::class, 'ShowProduksiHidup']);
Route::get('/show-produksi-mati', [ProduksiController::class, 'ShowProduksiMati']);
Route::get('/modal-create-produksi/{id}', [ProduksiController::class, 'ModalCreate']);
Route::get('/modal-update-produksi-inkubator/{id}', [ProduksiController::class, 'ModalUpdateInkubator']);
Route::get('/modal-update-produksi-hidup/{id}', [ProduksiController::class, 'ModalUpdateHidup']);
// Route::get('/modal-delete-produksi/{id}', [PanduanController::class, 'ModalDelete']);
// Route::get('/show-produksi', [PanduanController::class, 'ShowPanduan']);

Route::post('/produksi-telur', [ProduksiController::class, 'CreateProduksiTelur'])->name('create.produksi');
Route::patch('/produksi-inkubator/update/{id}', [ProduksiController::class, 'UpdateProduksiInkubator'])->name('update.produksi.inkubator');
Route::patch('/produksi-hidup/update/{id}', [ProduksiController::class, 'UpdateProduksiHidup'])->name('update.produksi.hidup');
Route::get('/produksi-inkubator', [ProduksiController::class, 'ProduksiInkubator'])->name('produksi.inkubator');
Route::get('/produksi-hidup', [ProduksiController::class, 'ProduksiHidup'])->name('produksi.hidup');
Route::get('/produksi-mati', [ProduksiController::class, 'ProduksiMati'])->name('produksi.mati');

// Hasil Produksi [X]
Route::get('/show-laporan-produksi-indukan', [HasilProduksiController::class, 'ShowLaporanProduksiIndukan']);
Route::get('/show-laporan-produksi-inkubator', [HasilProduksiController::class, 'ShowLaporanProduksiInkubator']);
Route::get('/show-laporan-produksi-mati', [HasilProduksiController::class, 'ShowLaporanProduksiMati']);
Route::get('/show-laporan-produksi-hidup', [HasilProduksiController::class, 'ShowLaporanProduksiHidup']);
Route::get('/show-laporan-produksi-terjual', [HasilProduksiController::class, 'ShowLaporanProduksiTerjual']);

Route::get('/modal-create-indukan', [HasilProduksiController::class, 'ModalCreateIndukan']);
Route::get('/modal-update-report-indukan/{id}', [HasilProduksiController::class, 'ModalUpdateReportIndukan']);
Route::get('/modal-update-report-hidup/{id}', [HasilProduksiController::class, 'ModalUpdateReportHidup']);
Route::get('/modal-print-hidup', [HasilProduksiController::class, 'ModalPrintHidup']);
Route::get('/modal-print-mati', [HasilProduksiController::class, 'ModalPrintMati']);


Route::get('/report-inkubator', [HasilProduksiController::class, 'ReportInkubator'])->name('report.inkubator');
Route::get('/report-hidup', [HasilProduksiController::class, 'ReportHidup'])->name('report.hidup');
Route::get('/report-mati', [HasilProduksiController::class, 'ReportMati'])->name('report.mati');
Route::get('/report-indukan', [HasilProduksiController::class, 'ReportIndukan'])->name('report.indukan');
Route::post('/create-indukan', [HasilProduksiController::class, 'CreateIndukan'])->name('create.indukan');
Route::patch('/update-indukan/{id}', [HasilProduksiController::class, 'UpdateIndukan'])->name('update.indukan');

//print laporan produksi
Route::get('/print-laporan-produksi-mati/{penangkaran}/{startDate}/{endDate}', [HasilProduksiController::class, 'PrintLaporanProduksiMati'])->name('print.laporan.produksi.mati');
Route::get('/print-laporan-produksi-hidup/{penangkaran}/{startDate}/{endDate}', [HasilProduksiController::class, 'PrintLaporanProduksiHidup'])->name('print.laporan.produksi.hidup');
Route::get('/print-sertifikat/{id}', [HasilProduksiController::class, 'PrintSertifikat']);

//get notification user
Route::get('/get-notifications', [UserController::class, 'getNotification']);
Route::get('/notification-read/{id}', [UserController::class, 'readNotification']);
Route::get('/notification-read-all', [UserController::class, 'readAllNotification'])->name('read.all.notification');

<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BillsDetailsController;
use App\Http\Controllers\BillArchiveController;
use App\Http\Controllers\ProdactsController;
use App\Http\Controllers\BillsAttachmentsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::get('/my-profile', function () {
    return view('users.my_profile');
})->middleware('auth')->name('my.profile');

// Auth::routes(['register' => false]);





// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::resource('BillAttachments', BillsAttachmentsController::class);
Route::resource('bills', BillController::class);
Route::resource('sections', SectionsController::class);
Route::resource('prodacts', ProdactsController::class);
Route::get('/section/{id}', [BillController::class, 'getprodacts']);
Route::get('/billsDetails/{id}', [BillsDetailsController::class, 'edit'])->name('billsDetails.edit');
Route::get('download/{bill_number}/{file_name}', [BillsDetailsController::class, 'get_file']);
Route::get('View_file/{bill_number}/{file_name}', [BillsDetailsController::class, 'open_file'])->name('view_file');
Route::post('delete_file', [BillsDetailsController::class, 'destroy'])->name('delete_file');
Route::get('/Status_show/{id}', [BillController::class, 'show'])->name('Status_show');
Route::post('/Status_Update/{id}', [BillController::class, 'Status_Update'])->name('Status_Update');
Route::get('/edit_bill/{id}', [BillController::class, 'edit']);
Route::get('bill_Paid', [BillController::class, 'bill_Paid']);
Route::get('bill_unPaid', [BillController::class, 'bill_unPaid']);
Route::get('bill_Partial', [BillController::class, 'bill_Partial']);
Route::resource('Archive', BillArchiveController::class);
Route::get('Print_bill/{id}', [BillController::class,'Print_bill']);
Route::get('/test-email', function () {
    try {
        Mail::raw('اختبار الإرسال عبر Mailtrap', function ($message) {
            $message->to('test@example.com') // ضع بريدك هنا
                    ->subject('تجربة إرسال بريد');
        });

        return 'تم إرسال البريد بنجاح!';
    } catch (\Exception $e) {
        return 'خطأ في الإرسال: ' . $e->getMessage();
    }
});
Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});






Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/{page}', [AdminController::class, 'index']);
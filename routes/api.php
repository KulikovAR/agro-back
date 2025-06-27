<?php

use App\Http\Controllers\AssetsController;
use App\Http\Controllers\Auth\AuthProviderController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\VerificationContactController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\V1\Auth\AuthTokenController;
use App\Http\Controllers\V1\BankAccountController;
use App\Http\Controllers\V1\CounteragentController;
use App\Http\Controllers\V1\FileController;
use App\Http\Controllers\V1\ManagerContoller;
use App\Http\Controllers\V1\OfferController;
use App\Http\Controllers\V1\OrderController;
use App\Http\Controllers\V1\SignMeController;
use App\Http\Controllers\V1\TgBotController;
use App\Http\Controllers\V1\TransportBrandController;
use App\Http\Controllers\V1\TransportController;
use App\Http\Controllers\V1\TransportTypeController;
use App\Http\Controllers\V1\UserProfileController;
use App\Http\Controllers\V1\WhatsAppController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// WhatsApp
Route::post('whatsapp/webhook', [WhatsAppController::class, 'webhook']);
Route::post('/bot/send-message', [TgBotController::class, 'sendMessage']);

// TG
Route::post('/bot-update', [TgBotController::class, 'update']);

// Guest
Route::middleware(['guest'])->group(function () {
    Route::post('/login', [AuthTokenController::class, 'store'])->name('login.stateless');
    Route::post('/login/verification', [AuthTokenController::class, 'verification'])->name('login.verification');
});


Route::middleware('auth:sanctum')->group(function () {
    // User
    Route::get('/managers', [ManagerContoller::class, 'list'])->name('managers.list');
    Route::get('/user', [AuthTokenController::class, 'getUser'])->name('user.get');
    Route::delete('/logout', [AuthTokenController::class, 'destroy'])->name('logout.stateless');

    // UserProfile
    Route::prefix('userprofile')->group(function () {
        Route::get('/', [UserProfileController::class, 'getUserProfileByToken'])->name(
            'userprofile.getUserProfileByToken'
        );

        Route::get('tax-systems', [UserProfileController::class, 'getTaxSystems'])->name('userprofile_tax-systems');

        Route::put('/update', [UserProfileController::class, 'update'])->name('userprofile.update');
        Route::put('/delete', [UserProfileController::class, 'delete'])->name('userprofile.delete');

        Route::post('avatar/create', [UserProfileController::class, 'loadAvatar'])->name('userprofile.avatar.create');
        Route::post('avatar/update/', [UserProfileController::class, 'updateAvatar'])->name('userprofile.avatar.update');
    });

    // SignMe
    Route::post('/sign-me', [SignMeController::class, 'signature'])->name('sign.me.signature');

    // Counteragents
    Route::prefix('counteragents')->group(function () {
        Route::get('/', [CounteragentController::class, 'index'])->name('counteragents.get');
        Route::get('/{user}', [CounteragentController::class, 'index'])->name('counteragents.index');
        Route::post('/', [CounteragentController::class, 'create'])->name('counteragent.create');
        Route::put('/{user}', [CounteragentController::class, 'update'])->name('counteragent.update');
    });


    // BankAccounts
    Route::prefix('bank-accounts')->group(function () {
        Route::get('/', [BankAccountController::class, 'index'])->name(
            'bank_accounts.index.logistician'
        );
        Route::get('/{bankAccount}', [BankAccountController::class, 'show'])->name(
            'bank_accounts.show.carrier'
        );
        Route::post('/', [BankAccountController::class, 'create'])->name('bank_accounts.create');
        Route::put('/{bankAccount}', [BankAccountController::class, 'update'])->name('bank_accounts.update');
        Route::delete('/{bankAccount}', [BankAccountController::class, 'delete'])->name('bank_accounts.delete');
    });

    // Files
    Route::prefix('files')->group(function () {
        Route::get('/', [FileController::class, 'index'])->name('files.index');
        Route::get('/on-signing', [FileController::class, 'getDocumentsForSigning'])->name('files.signing');
        Route::get('show/{file}', [FileController::class, 'show'])->name('files.show');
        Route::post('/create/', [FileController::class, 'create'])->name('files.create');
        Route::put('/update/{file}', [FileController::class, 'update'])->name('files.update');
        Route::post('/load-files', [FileController::class, 'loadFilesForUser'])->name('files.load_files');
        Route::post('/update-files', [FileController::class, 'updateFilesForUser'])->name('files.update_files');
        Route::delete('/delete-files', [FileController::class, 'deleteUserFiles'])->name('files.delete_files');
        Route::get('/file-types', [FileController::class, 'getFileTypes'])->name('files.getFileTypes');
        Route::delete('/delete/{file}', [FileController::class, 'delete'])->name('files.delete');
        Route::post('/from-1c/{inn}', [FileController::class, 'loadFileFrom1C'])->name('files.from-1c');
    });

    // Transport
    Route::prefix('transport')->group(function () {
        Route::get('/', [TransportController::class, 'index'])->name('transport.index');
        Route::get('/{id}', [TransportController::class, 'show'])->name('transport.show');
        Route::post('/create', [TransportController::class, 'create'])->name('transport.create');
        Route::put('/update/{transport}', [TransportController::class, 'update'])->name('transport.update');
        Route::delete('/delete/{transport}', [TransportController::class, 'delete'])->name('transport.delete');
        Route::get('/manual/brands', [TransportBrandController::class, 'index'])->name('transport.brands');
        Route::get('/manual/types', [TransportTypeController::class, 'index'])->name('transport.types');
    });

    // Orders
    Route::prefix('orders')->group(function () {
        Route::get('/export/local', [OrderController::class, 'exportLocal'])->name('order.export-local');
        Route::get('/export/public', [OrderController::class, 'exportPublic'])->name('order.export-public');
        Route::post('/create', [OrderController::class, 'create'])->name('order.create');
        Route::post('/update/{order}', [OrderController::class, 'update'])->name('order.update');
        Route::delete('/delete/{order}', [OrderController::class, 'delete'])->name('order.delete');
        Route::get('/regions', [OrderController::class, 'getRegions'])->name('order.regions');
        Route::get('/cities', [OrderController::class, 'getCities'])->name('order.cities');
        Route::get('/', [OrderController::class, 'index'])->name('order.index');
        Route::get('/{order}', [OrderController::class, 'show'])->name('order.show');
    });

    Route::get('/user-orders', [OrderController::class, 'getOrdersWithUserOffers'])->name('order.user.orders');

    Route::prefix('offers')->group(function () {
        Route::post('/create', [OfferController::class, 'create'])->name('offer.create');
    });
    Route::prefix('options')->group(function () {
        Route::get('/', [OrderController::class, 'getOptions'])->name('order.get_options');
    });

    Route::middleware('verified')->group(function () {
        Route::get('/user_profile', [UserProfileController::class, 'index'])->name('user_profile.index');
        Route::post('/user_profile', [UserProfileController::class, 'store'])->name('user_profile.store');
        Route::post('/user_profile/avatar', [UserProfileController::class, 'storeAvatar'])->name(
            'user_profile.store.avatar'
        );
    });
});

Route::get('/assets/{locale?}', [AssetsController::class, 'show'])->name('assets.index');

<?php

use App\Http\Controllers\AssetsController;
use App\Http\Controllers\Auth\AuthProviderController;
use App\Http\Controllers\Auth\AuthTokenController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\VerificationContactController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\V1\UserProfileController;
use App\Http\Controllers\V1\OfferController;
use App\Http\Controllers\V1\ProductParserController;
use App\Http\Controllers\V1\TransportController;
use Telegram\Bot\Laravel\Facades\Telegram;
use App\Models\Role;
use App\Models\User;
use App\Notifications\AdminNotification;
use App\Notifications\PasswordResetNotification;
use Database\Seeders\UserSeeder;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\OrderController;
use App\Http\Controllers\V1\CounteragentController;
use App\Http\Controllers\V1\TransportBrandController;
use App\Http\Controllers\V1\TransportTypeController;
use \App\Http\Controllers\V1\FileController;
use \App\Http\Controllers\V1\BankAccountController;
use App\Http\Controllers\V1\WhatsAppController;

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

Route::post('whatsapp/webhook', [WhatsAppController::class, 'webhook']);

//Route::prefix('products-parser')->group(function () {
//    Route::get('/get-filters', [ProductParserController::class, 'getProductFilter'])->name('product-parser.get-filter');
//    Route::get('/', [ProductParserController::class, 'index'])->name('product-parser.index');
//});

Route::middleware(['guest'])->group(function () {
    Route::post('/registration/phone', [RegistrationController::class, 'registration'])->name('registration');
    Route::post('/registration/verification', [RegistrationController::class, 'verification'])->name(
        'register.verification'
    );
    Route::put('/code/update/{user}', [RegistrationController::class, 'codeUpdate'])->name('code.update');
    Route::post('/login', [AuthTokenController::class, 'store'])->name('login.stateless');
    Route::post('/login/verification', [AuthTokenController::class, 'verification'])->name('login.verification');
    Route::delete('/logout', [AuthTokenController::class, 'destroy'])->name('logout');
    Route::get('/user', [AuthTokenController::class, 'getUser'])->name('get_user');

    // Route::post('/password/send', [PasswordController::class, 'sendPasswordLink'])->middleware(['throttle:6,1'])->name('password.send');
    // Route::post('/password/reset', [PasswordController::class, 'store'])->name('password.reset');
});


Route::post('/bot/send-message', [\App\Http\Controllers\V1\TgBotController::class, 'sendMessage']);





Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('userprofile')->group(function () {
        Route::get('/', [UserProfileController::class, 'getUserProfileByToken'])->name(
            'userprofile.getUserProfileByToken'
        );
        Route::post('avatar/create', [UserProfileController::class, 'loadAvatar'])->name('userprofile.avatar.create');
        Route::post('avatar/update/', [UserProfileController::class, 'updateAvatar'])->name(
            'userprofile.avatar.update'
        );
        Route::put('/delete', [UserProfileController::class, 'delete'])->name('userprofile.delete');
        Route::put('/update', [UserProfileController::class, 'update'])->name('userprofile.update');
//        Route::put('password/update', [UserProfileController::class, 'updatePassword'])->name(
//            'userprofile.password.update'
//        );
    });

    Route::prefix('counteragents')->group(function () {
        Route::post('/', [CounteragentController::class, 'create'])->name('counteragent.create');
        Route::put('/{user}', [CounteragentController::class, 'update'])->name('counteragent.update');
    });

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
    Route::prefix('files')->group(function () {
        Route::get('/', [FileController::class, 'index'])->name('files.index');
        Route::get('/on-signing', [FileController::class, 'getDocumentsForSigning'])->name('files.signing');
        Route::get('show/{file}', [FileController::class, 'show'])->name('files.show');
        Route::post('/create/', [FileController::class, 'create'])->name('files.create');
        Route::put('/update/{file}', [FileController::class, 'update'])->name('files.update');
        Route::post('/load-files', [FileController::class, 'loadFilesForUser'])->name('files.load_files');
        Route::post('/update-files',[FileController::class, 'updateFilesForUser'])->name('files.update_files');
        Route::delete('/delete-files',[FileController::class, 'deleteUserFiles'])->name('files.delete_files');
        Route::get('/file-types', [FileController::class, 'getFileTypes'])->name('files.getFileTypes');
        Route::delete('/delete/{file}', [FileController::class, 'delete'])->name('files.update');
        Route::post('/from-1c/{inn}', [FileController::class, 'loadFileFrom1C'])->name('files.from-1c');
    });

    Route::prefix('transport')->group(function () {
        Route::get('/', [TransportController::class, 'index'])->name('transport.index');
        Route::get('/{id}', [TransportController::class, 'show'])->name('transport.show');
        Route::post('/create', [TransportController::class, 'create'])->name('transport.create');
        Route::put('/update/{transport}', [TransportController::class, 'update'])->name('transport.update');
        Route::delete('/delete/{transport}', [TransportController::class, 'delete'])->name('transport.delete');
        Route::get('/manual/brands', [TransportBrandController::class, 'index'])->name('transport.brands');
        Route::get('/manual/types', [TransportTypeController::class, 'index'])->name('transport.types');
    });
    Route::prefix('orders')->group(function () {
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
    Route::get('userprofile/tax-systems', [UserProfileController::class, 'getTaxSystems'])->name('userprofile_tax-systems');

    Route::post('/verification/email', [VerificationContactController::class, 'sendEmailVerification'])->name(
        'verification.email.send'
    );

    Route::prefix('notification')->group(function () {
        Route::get('/', [NotificationController::class, 'index'])->name('notification.index');
        Route::post('/{id}', [NotificationController::class, 'edit'])->name('notification.edit');
    });

    Route::patch('/password', [PasswordController::class, 'update'])->name('password.update');
    Route::delete('/logout', [AuthTokenController::class, 'destroy'])->name('logout.stateless');

    Route::middleware('verified')->group(function () {
        Route::get('/user_profile', [UserProfileController::class, 'index'])->name('user_profile.index');
        Route::post('/user_profile', [UserProfileController::class, 'store'])->name('user_profile.store');
        Route::post('/user_profile/avatar', [UserProfileController::class, 'storeAvatar'])->name(
            'user_profile.store.avatar'
        );
    });
});


Route::get('/auth/{provider}/redirect', [AuthProviderController::class, 'redirectToProvider'])->middleware(
    'throttle:10,1'
)->name('provider.redirect');
Route::get('/auth/{provider}/callback', [AuthProviderController::class, 'loginOrRegister'])->name('provider.callback');

Route::get('/verification/{id}/{hash}', [VerificationContactController::class, 'verifyEmail'])->middleware(
    ['signed', 'throttle:6,1']
)->name('verification.email.url');

Route::get('/assets/{locale?}', [AssetsController::class, 'show'])->name('assets.index');



Route::get('/mail', function () {
    $admin = User::role(Role::ROLE_ADMIN)->get()->first();
    $admin->notify(new AdminNotification('$message'));

    $notification = new PasswordResetNotification('Order');

    $user = User::where('email', UserSeeder::USER_EMAIL)->first(); // Model with Notifiable trait

    $message = $notification->toMail($user);

    $markdown = new \Illuminate\Mail\Markdown(view(), config('mail.markdown'));

    return $markdown->render('vendor.notifications.email', $message->toArray());
});

Route::post('/bot-update',[\App\Http\Controllers\V1\TgBotController::class,'update']);

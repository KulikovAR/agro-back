<?php

use App\Http\Controllers\AssetsController;
use App\Http\Controllers\Auth\AuthProviderController;
use App\Http\Controllers\Auth\AuthTokenController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\VerificationContactController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\V1\ProductParserController;
use App\Http\Controllers\V1\TransportController;

use App\Models\Role;
use App\Models\User;
use App\Notifications\AdminNotification;
use App\Notifications\PasswordResetNotification;
use Database\Seeders\UserSeeder;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FaqTagController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\GoodController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\ParameterController;
use App\Http\Controllers\StoreChatController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\V1\CounteragentController;

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
Route::prefix('products-parser')->group(function(){
    Route::get('get-filters',[ProductParserController::class,'getProductFilter'])->name('product-parser.get-filter');
    Route::get('/',[ProductParserController::class,'index'])->name('product-parser.index');
});
Route::prefix('counteragents')->group(function(){
    Route::get('/',[CounteragentController::class,'index'])->name('counteragent.index');
    Route::get('/{$counteragent}',[CounteragentController::class,'show'])->name('counteragent.show');
    Route::post('/create',[CounteragentController::class,'create'])->name('counteragent.create');
    Route::put('/update/{$counteragent}',[CounteragentController::class,'update'])->name('counteragent.update');
    Route::delete('/delete/{$counteragent}',[CounteragentController::class,'delete'])->name('counteragent.update');
});
Route::middleware(['guest'])->group(function () {
    Route::post('/registration/phone', [RegistrationController::class, 'registration'])->name('registration');
    Route::post('/registration/verification',[RegistrationController::class,'verification'])->name('register.verification');
    Route::put('/code/update/{user}',[RegistrationController::class,'codeUpdate'])->name('code.update');
    Route::post('/login', [AuthTokenController::class, 'store'])->name('login.stateless');
    Route::post('/login/verification',[AuthTokenController::class, 'verification'])->name('login.verification');
    Route::get('/transport/manual/brands',[TransportBrandController::class,'index'])->name('transport.brands');
    Route::get('/transport/manual/types',[TransportTypeController::class,'index'])->name('transport.types');
    // Route::post('/password/send', [PasswordController::class, 'sendPasswordLink'])->middleware(['throttle:6,1'])->name('password.send');
    // Route::post('/password/reset', [PasswordController::class, 'store'])->name('password.reset');
});

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/verification/email', [VerificationContactController::class, 'sendEmailVerification'])->name('verification.email.send');

    Route::prefix('notification')->group(function () {
        Route::get('/', [NotificationController::class, 'index'])->name('notification.index');
        Route::post('/{id}', [NotificationController::class, 'edit'])->name('notification.edit');
    });

    Route::patch('/password', [PasswordController::class, 'update'])->name('password.update');
    Route::delete('/logout', [AuthTokenController::class, 'destroy'])->name('logout.stateless');

    Route::middleware('verified')->group(function () {
        Route::get('/user_profile', [UserProfileController::class, 'index'])->name('user_profile.index');
        Route::post('/user_profile', [UserProfileController::class, 'store'])->name('user_profile.store');
        Route::post('/user_profile/avatar', [UserProfileController::class, 'storeAvatar'])->name('user_profile.store.avatar');
    });
});

Route::get('/auth/{provider}/redirect', [AuthProviderController::class, 'redirectToProvider'])->middleware('throttle:10,1')->name('provider.redirect');
Route::get('/auth/{provider}/callback', [AuthProviderController::class, 'loginOrRegister'])->name('provider.callback');

Route::get('/verification/{id}/{hash}', [VerificationContactController::class, 'verifyEmail'])->middleware(['signed', 'throttle:6,1'])->name('verification.email.url');

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

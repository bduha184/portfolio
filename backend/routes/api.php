<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TeamController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return response()->json([
            'user'=>$request->user()
        ]);
    });

    Route::controller(UserController::class)->group(function(){
        Route::prefix('user')->group(function () {
            Route::put('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });
    });


    Route::controller(TeamController::class)->group(function(){
        Route::prefix('team')->name('team.')->group(function(){
            Route::post('/register','store');
            Route::put('/{id}','update');
            Route::delete('/{id}','destroy');
        });
    });
    Route::controller(ProfileController::class)->group(function(){
        Route::prefix('profile')->name('profile.')->group(function(){
            Route::post('/register','store');
            Route::put('/{id}','update');
            Route::delete('/{id}','destroy');
        });
    });

    Route::controller(MessageController::class)->group(function(){
        Route::prefix('message')->name('message.')->group(function(){
            Route::post('/register','store');
            Route::put('/{id}','update');
        });
    });
    Route::controller(TagController::class)->group(function(){
        Route::prefix('tag')->name('tag.')->group(function(){
            Route::post('/register','store');
        });
    });
    Route::controller(ImagesController::class)->group(function(){
        Route::prefix('image')->name('image.')->group(function(){
            Route::post('/register','store');
            Route::put('/{id}','update');
            Route::delete('/{id}','destroy');
        });
    });
});

Broadcast::routes(['middleware' => ['auth:sanctum']]);

Route::controller(TeamController::class)->group(function(){
    Route::prefix('team')->name('team.')->group(function(){
        Route::get('/','index')->name('index');
        Route::get('/auth','select_team');
        Route::get('/{id}','show')->name('show');
    });
});

Route::controller(ImagesController::class)->group(function(){
    Route::prefix('image')->name('image.')->group(function(){
        Route::get('/{id}','show');
    });
});

Route::controller(ProfileController::class)->group(function(){
    Route::prefix('profile')->name('profile.')->group(function(){
    Route::get('/','index')->name('index');
    Route::get('/{id}','show')->name('show');
    });
});

Route::controller(MessageController::class)->group(function(){
    Route::prefix('message')->name('message.')->group(function(){
        Route::get('/','index');
        Route::get('/{id}','show');
    });
});
Route::post('/logout', [LoginController::class, 'logout']);

Route::prefix('login')->name('login.')->group(function() {
    Route::post('/', [LoginController::class, 'login'])->name('login');
    Route::post('/guestlogin', [LoginController::class, 'guestLogin'])->name('guest');
    Route::get('/{provider}', [LoginController::class, 'redirectToProvider'])->name('{provider}');
    Route::post('/{provider}/callback', [LoginController::class, 'handleProviderCallback'])->name('{provider}/callback');
});

Route::controller(UserController::class)->group(function(){
    Route::prefix('user')->name('user.')->group(function(){
        Route::get('/{id}','show');
    });
    Route::prefix('register')->name('register.')->group(function () {
        Route::post('/', 'register');
        Route::get('/{provider}', 'showProviderUserRegistrationForm')->name('{provider}');
        Route::post('/{provider}', 'registerProviderUser')->name('{provider}');
    });
});

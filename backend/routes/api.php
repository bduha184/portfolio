<?php

use App\Http\Controllers\ImagesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RideController;
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
        Route::get('/myteam','get_my_team');
        Route::get('/search','search_team');
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

Route::controller(LoginController::class)->group(function(){
    Route::prefix('login')->name('login.')->group(function() {
        Route::post('/', 'login')->name('login');
        Route::post('/guestlogin', 'guestLogin')->name('guest');
        Route::get('/{provider}', 'redirectToProvider')->name('{provider}');
        Route::post('/{provider}/callback', 'handleProviderCallback')->name('{provider}/callback');
    });
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

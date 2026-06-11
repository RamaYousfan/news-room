<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\ArticleController as V1ArticleController;
use App\Http\Controllers\Api\V1\CommentController as V1CommentController;
use App\Http\Controllers\Api\V2\ArticleController as V2ArticleController;
use App\Http\Controllers\Api\V1\AttachmentController as V1AttachmentController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| 🔵 V1 API
|--------------------------------------------------------------------------
*/

Route::prefix('v1')->name('v1.')->group(function () {

        Route::post('/login', [AuthController::class, 'login'])->name('login');


        Route::middleware('auth:sanctum')->group(function () {

                Route::post( '/logout', [AuthController::class, 'logout'] )->name('logout');

   Route::post('articles/{article}/publish', [V1ArticleController::class, 'publish']);

                Route::apiResource('articles',V1ArticleController::class );
                Route::apiResource( 'comments', V1CommentController::class);
                Route::post('articles/{article}/attachments',[V1AttachmentController::class, 'store']
);

            });

    });



/*
|--------------------------------------------------------------------------
| 🟣 V2 API
|--------------------------------------------------------------------------
*/

Route::prefix('v2') ->name('v2.')->middleware(['auth:sanctum','request.log','rate.limit'])->group(function () {

        Route::apiResource('articles',V2ArticleController::class );

    });
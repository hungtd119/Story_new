<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\PageController;
use App\Http\Middleware\CheckParentRecordStory;
use App\Http\Middleware\CheckParentRecordImage;
use App\Http\Controllers\TextController;
use App\Http\Controllers\AudioController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\InteractionController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\TextconfigController;
use App\Http\Middleware\CheckParentRecordText;

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

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/loadUser', [AuthController::class, 'loadUser']);
});
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return "Ok";
//});
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/user', function () {
        return 'ok';
    });
});
Route::prefix('story')->group(function () {
    Route::get('/', [StoryController::class, 'index']);
    Route::get('/find/{id}', [StoryController::class, 'findById']);
    Route::get('/detail/{id}', [StoryController::class, 'getStoryDetailById']);
    Route::delete('/{id}', [StoryController::class, 'delete']);
    Route::put('/', [StoryController::class, 'update']);
    Route::middleware([CheckParentRecordImage::class])->group(function () {
        Route::post('/', [StoryController::class, 'create']);
    });
    Route::middleware('auth:sanctum')->group(function () {
    });

    Route::get('/cards', [StoryController::class, 'getStoriesCard']);
});
Route::prefix('page')->group(function () {
    Route::get('/', [PageController::class, 'index']);
    Route::get('/find/{id}', [PageController::class, 'findById']);
    Route::get('/findByStoryId/{id}', [PageController::class, 'findByStory']);
    Route::get('/getByStoryId', [PageController::class, 'getByStoryId']);
    Route::get('/id/{storyId}', [PageController::class, 'getPagesId']);
    Route::get('/config/{id}', [PageController::class, 'getPageToConfig']);
    Route::get('/play/{id}', [PageController::class, 'getPageToPlay']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::delete('/{id}', [PageController::class, 'delete']);
    });
    Route::middleware([
        CheckParentRecordStory::class,
        CheckParentRecordImage::class
    ])->group(function () {
        Route::post('/', [PageController::class, 'create']);
        Route::put('/', [PageController::class, 'update']);
    });
});
Route::prefix('text')->group(function () {
    Route::get('/', [TextController::class, 'index']);
    Route::get('/find/{id}', [TextController::class, 'findById']);
    Route::delete('/{id}', [TextController::class, 'delete']);
    Route::post('/', [TextController::class, 'create']);
    Route::put('/', [TextController::class, 'update']);
    Route::middleware('auth:sanctum')->group(function () {
    });
});
Route::prefix('audio')->group(function () {
    Route::get('/', [AudioController::class, 'index']);
    Route::get('/find/{id}', [AudioController::class, 'findById']);
    Route::middleware([CheckParentRecordText::class])->group(function () {
        Route::post('/', [AudioController::class, 'create']);
        Route::put('/', [AudioController::class, 'update']);
    });
    Route::middleware('auth:sanctum')->group(function () {
        Route::delete('/{id}', [AudioController::class, 'delete']);
    });
});
Route::prefix('image')->group(function () {
    Route::get('/', [ImageController::class, 'index']);
    Route::post('/', [ImageController::class, 'create']);
});
Route::prefix('interaction')->group(function () {
    Route::get('/positions/{id}', [InteractionController::class, 'getAllByPageId']);
    Route::post('/', [InteractionController::class, 'create']);
    Route::get('/{id}', [InteractionController::class, 'getInteractionFull']);
});
Route::prefix('position')->group(function () {
    Route::post('/positions', [PositionController::class, 'createPositionsByInteraction']);
});
Route::prefix('textconfig')->group(function () {
    Route::post('/', [TextconfigController::class, 'create']);
});

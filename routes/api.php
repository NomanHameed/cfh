<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\MobileApiController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::controller(MobileApiController::class)->group(function () {
// 	/*
// 	|--------------------------------------------------------------------------
// 	| Wolfaram Routes
// 	|--------------------------------------------------------------------------
// 	| All route related to wolfarma api
// 	*/
// 	Route::group(['prefix' => 'token'], function (){
//     	Route::get('list',		'apiTokenList' );
//     	Route::post('edit',		'apiTokenUpdate' );
//     });

// 	/*
// 	|--------------------------------------------------------------------------
// 	| Questionner Routes
// 	|--------------------------------------------------------------------------
// 	| All route related to Questionner api
// 	*/
// 	Route::group(['prefix' => 'questionner'], function (){
//     	Route::get('topics',		'topicList');
//     	Route::get('quizez/{id}',	'quizList' );
//     });
// });

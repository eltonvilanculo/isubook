<?php

use App\Http\Controllers\apiClientController;
use App\Http\Controllers\apiProductController;
use App\Http\Controllers\apiSaleController;
use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});;

Route::get('products',[apiProductController::class,'index']);
Route::get('clients',[apiClientController::class,'index']);

Route::post('clients',[apiClientController::class,'store']);

Route::post('sale',[apiSaleController::class,'store']);

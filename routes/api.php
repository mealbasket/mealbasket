<?php

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

Route::get('recipe/check/{site_id}', 'ApiController@checkBySiteId');
Route::post('recipe', 'ApiController@storeRecipe');
Route::post('tags', 'ApiController@storeTags');
Route::post('nutrition', 'ApiController@storeNutrition');
Route::post('steps', 'ApiController@storeSteps');
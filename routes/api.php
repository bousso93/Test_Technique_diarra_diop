<?php

use Illuminate\Http\Request;
//use Symfony\Component\Routing\Route;

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

Route::apiResource('/posts','PostController');
Route::apiResource('/categories','CategoryController');
Route::apiResource('/comments','CommentController');
Route::get('/posts/category/{slug}', 'PostController@category');
Route::post('/users/register', 'UsersController@register');
Route::post('/users/login', 'UsersController@login');
Route::apiResource('/offres','OffreController');
Route::apiResource('/secteurs','SecteurActiviteController');
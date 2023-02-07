<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return response()->json([
        'success' => 'The api is alive, you can test its functionality',
        'api_docs' => url()->current() . '/docs',
        'api_docs_postman' => url()->current() . '/documentation',
    ]);
});

Route::get('/documentation', function () {
    header('Location: https://documenter.getpostman.com/view/2153586/2s8ZDX4NXX');
    exit();
});

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// references
// json get request (API Routes)
Route::get('posts', function() {                // test request: /api/posts
    return response()->json([
        'posts' =>[
            [
                'title' => 'Post One'
            ]
        ]
    ]);
});

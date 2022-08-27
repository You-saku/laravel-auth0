<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // これが必要
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * - auth0.authorize
 *   Requires a valid bearer token to access the route.
 */
Route::get('/api/private', function () {
    return response()->json([
        'authorized' => true,
        // 'user' => json_decode(json_encode((array) Auth::user(), JSON_THROW_ON_ERROR), true),
        'user' => Auth::user(),
    ], 200, [], JSON_PRETTY_PRINT);
})->middleware(['auth0.authorize']);

/**
 * - auth0.authorize:scope
 *   Requires a valid bearer token with the defined scope to access the route.
 */
Route::get('/api/private-scoped', function () {
    return response()->json([
        'authorized' => true,
        // 'user' => json_decode(json_encode((array) Auth::user(), JSON_THROW_ON_ERROR), true),
        'user' => Auth::user(),
    ], 200, [], JSON_PRETTY_PRINT);
})->middleware(['auth0.authorize:offline_access']);

/**
 * - auth0.authorize.optional
 *   Resolves the bearer token to a user model when provided, but will not stop requests without one.
 */
Route::get('/api/public', function () {
    if (Auth::check()) {
        return response()->json([
            'authorized' => true,
            // 'user' => json_decode(json_encode((array) Auth::user(), JSON_THROW_ON_ERROR), true),
            'user' => Auth::user(),
        ], 200, [], JSON_PRETTY_PRINT);
    }

    return response()->json([
        'authorized' => false,
        'user' => null,
    ], 200, [], JSON_PRETTY_PRINT);
})->middleware(['auth0.authorize.optional']);

<?php

use App\User;
use Illuminate\Support\Facades\Hash;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::post('/login', function (Request $request) {
//     $data = $request->validate([
//         'email' => 'required|email',
//         'password' => 'required'
//     ]);

//     $user = User::where('email', $request->email)->first();

//     if (!$user || !Hash::check($request->password, $user->password)) {
//         return response([
//             'message' => ['These credentials do not match our records.']
//         ], 404);
//     }

//     $token = $user->createToken('my-app-token')->plainTextToken;

//     $response = [
//         'user' => $user,
//         'token' => $token
//     ];

//     return response($response, 201);
// });

// Route::post('/register', function (Request $request) {
//     $data = $request->validate([
//         'email' => 'required|email',
//         'password' => 'required'
//     ]);

//     if (!User::where('email', $request->email)->first()) {
//         $new_user = new User;
//         $new_user->email = $request->email;
//         $new_user->password = Hash::make($request->password);
//         $new_user->save();
//         return response([
//             'credentials' => [
//                 'email' => $new_user->email,
//                 'password' => $new_user->password
//             ],
//             'message' => 'Successfuly registered!',
//             'success' => true
//         ], 201);
//     } else {
//         return response([
//             'message' => 'User already exists.',
//             'success' => false
//         ], 404);
//     }
// });

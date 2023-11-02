<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoginResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiAuthController extends Controller
{
      //login
      public function login(LoginRequest $request)
      {
          //validate dengan Auth::attempt
          if (Auth::attempt($request->only('email', 'password'))) {

              $user = User::where('email', $request->email)->first();

              $user->tokens()->delete();

              $token = $user->createToken('token')->plainTextToken;
              return new LoginResource([
                  'token' => $token,
                  'user' => $user
              ]);
          } else {
              return response()->json([
                  'message' => 'Invalid Credentials'
              ], 401);
          }
      }

}

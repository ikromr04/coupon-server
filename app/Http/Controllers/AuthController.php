<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
  public function login()
  {
    request()->validate([
      'email' => 'required',
      'password' => 'required',
    ]);

    $user = User::where('email', request('email'))->first();

    if (!$user || !Hash::check(request('password'), $user->password)) {
      return response(['message' => 'Неверные учетные данные'], 400);
    }

    $user->token = $user->createToken('token')->plainTextToken;

    return $user;
  }

  public function check()
  {
    $user = auth()->user();
    $user->token = request()->bearerToken();
    $user->avatar = asset($user->avatar);

    return $user;
  }

  public function logout()
  {
    request()->user()->currentAccessToken()->delete();
  }
}

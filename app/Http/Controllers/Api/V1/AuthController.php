<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Traits\ApiResponse;

class AuthController extends Controller
{   use ApiResponse;
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('api-token')->plainTextToken;

     return $this->success([
    'user' => $user,
    'token' => $token],
    'Login successful');
    }

    public function logout()
{

    /** @var User|null $user */
    $user =
    Auth::user();


    if($user){ $user->currentAccessToken()?->delete(); }


return $this->success(null, 'Logged out');
}
}
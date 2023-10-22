<?php

namespace App\Http\Controllers\Api\Auth;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Wallet;
use App\Helpers\UuidGenerator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ApiUserLoginRequest;
use App\Http\Requests\ApiUserRegisterRequest;

class AuthController extends Controller
{
    public function register(ApiUserRegisterRequest $request) 
    {
        $attributes = $request->validated();

        $user = User::create($attributes);

        Wallet::firstOrCreate(
            [
                'user_id' => $user->id,
            ],
            [
                'user_id' => $user->id,
                'account_number' => UuidGenerator::GenerateAccountNumber(),
            ]
        );

        $user->update([
            'ip' => $request->ip(),
            'login_at' => Carbon::now(),
            'user_agent' => $request->server("HTTP_USER_AGENT")
        ]);

        $token = $user->createToken('Easy Pay')->accessToken;

        return success('Successfully registered', ['token' => $token]);
    }

    public function login(ApiUserLoginRequest $request) 
    {
        $attributes = $request->validated();

        if(Auth::attempt($attributes)) {
            $user = auth()->user();

            $user->update([
                'ip' => $request->ip(),
                'login_at' => Carbon::now(),
                'user_agent' => $request->server("HTTP_USER_AGENT")
            ]);

            Wallet::firstOrCreate(
                [
                    'user_id' => $user->id,
                ],
                [
                    'user_id' => $user->id,
                    'account_number' => UuidGenerator::GenerateAccountNumber(),
                ]
            );

            $token = $user->createToken('Easy Pay')->accessToken;

            return success('Successfully logged in.', ['token' => $token]);
        }

        return fail('This credentials does not match our records.', null);
    }

    public function logout() 
    {
        auth()->user()->token()->revoke();
        
        return success('successfully logout.', null);
    }
}

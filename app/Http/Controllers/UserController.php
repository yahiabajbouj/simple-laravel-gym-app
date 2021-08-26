<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Resources\UserResourse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function Register(RegisterRequest $request)
    {
        try {
            $request['password'] = Hash::make($request['password']);
            $request['remember_token'] = Str::random(10);
            $user = User::create($request->toArray());
            $user->customer()->create($request->toArray());
            $token = $user->createToken('token')->accessToken;
            $user = new UserResourse($user);
            $response = ["user" => $user, 'token' => $token];
            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json(["messages" => $e->getMessage()], 500);
        }
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('token')->accessToken;
                $response = ["user" => new UserResourse($user), 'token' => $token];
                return response()->json($response);
            } else {
                return response()->json(["messages" => "Password mismatch"], 500);
            }
        } else {
            return response()->json(["messages" => "User does not exist"], 500);
        }
    }

    public function getNotification()
    {
        $d = ['notifications' => Auth::user()->notifications, 'unreadNotificationsCount' => Auth::user()->unreadNotifications->count()];
        Auth::user()->unreadNotifications->markAsRead();
        return $d;
    }
}

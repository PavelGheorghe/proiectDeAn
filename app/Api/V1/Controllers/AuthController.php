<?php

namespace App\Api\V1\Controllers;

use App\Helpers\JWT;
use App\Http\Controllers\Controller;
use App\Models\User;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Socialite;
use Ramsey\Uuid\Uuid;

class AuthController extends Controller
{
    use Helpers;

    /**
     * Sign into the system.
     *
     * @route POST /api/auth/login
     *
     * @param Request $request
     *
     * @return array
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|exists:users,email',
            'password' => 'required|string',
        ]);

        // Authentication
        $token = JWT::login($request->email, $request->password);

        return [
            'data' => ['token' => $token],
        ];
    }

    public function loginfacebook(Request $request)
    {
        $data = Socialite::driver('facebook')->userFromToken($request->token);

        $user = User::where(['email' => $data->email, 'facebook_id' => $data->id, 'status' => User::USER_STATUS_ACTIVE])->first();

        if (!$user1) {
            abort(404, 'Not Font User');
        }

        $token = JWT::loginfacebook($user);

        return [
            'data' => ['token' => $token],
        ];
    }

    public function restorePassword(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|email|max:255|exists:users,email,deleted_at,NULL',
        ]);

        $user = User::where('email', $request->email)->first();
        $password = mb_substr(Uuid::uuid4(), -6);
        $user->password = bcrypt($password);
        $user->save();

        return response()->json(['data' => 'Parola a fost schimbata']);
    }
}

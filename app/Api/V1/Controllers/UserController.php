<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Api\V1\Transformers\UserTransformer;
use DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $rules = config('validations.web.user.create');
        $this->validate($request, $rules);
        $roles = $request['roles'];
        $input = $request->except(['roles']);
        $input['password'] = bcrypt($input['password']);

        $user = DB::transaction(function () use ($input , $roles) {
            $user = User::create($input);
            $user->roles()->sync($roles);

            return $user;
        });

        $token = JWTAuth::fromUser($user);

        $data['token'] = (string) $token;
        $data['user'] = fractal($user, new UserTransformer())->toArray()['data'];

        return response()->json(['data' => [$data]]);
    }
}

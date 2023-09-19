<?php

namespace App\Repository\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repository\Auth\AuthRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AuthRepository implements AuthRepositoryInterface
{
    public function __construct(Controller $response)
    {
        $this->response = $response;
    }

    public function register($data, $userId = null)
    {
        if ($userId) {
            $userObj = User::find($userId);
            $userObj->fill($data);
            $userObj->save();
            return $userObj;
        }
        $data['email_verified_at'] = Carbon::now();
        $data['created_by'] = auth()->user() ? auth()->user()->id : 0;
        $data['password'] = Hash::make($data['password']);
        $userObj = User::create($data);
        return $userObj;
    }

    public function login(array $data)
    {
        if (Auth::attempt($data)) {
            $user = User::where("email", $data['email'])->first();
            if (empty($user)) {
                return $this->response->sendResponse(false, 'Unauthorized', '', 401);
            }

            $tokenResult = auth()->user()->createToken(config('constants.APP_AUTH_TOKEN'))->accessToken;
            $result['user_id'] = $user->id;
            $result['name'] = data_get($user, 'name');
            $result['email'] = data_get($user, 'email');
            $result['token_type'] = 'Bearer';
            $result['access_token'] = $tokenResult;

            return $this->response->sendResponse(true, 'Login successfully', $result, 200);
        } else {
            return $this->response->sendErrorResponse(false, 'You have entered wrong email and password.', null, 400);
        }
    }
}

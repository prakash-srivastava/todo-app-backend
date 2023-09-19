<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repository\Auth\AuthRepositoryInterface;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    function __construct(AuthRepositoryInterface $authRepo)
    {
       $this->authRepo = $authRepo;
    }

    /**
    * Register User
    * @param RegisterRequest $request
    * @return token & Send Response Message
    * @author Prakash Srivastava
    */
    public function register(RegisterRequest $request)
    {
        DB::beginTransaction();
        try {
            $requestData = $request->only([
                'name', 'email', 'password'
            ]);
            $result = $this->authRepo->register($requestData, $request->user_id);
            DB::commit();
            return $this->sendResponse(true, "User register successfully.", $result, 200);
        } catch (\Throwable $e) {
            DB::rollBack();
            return $this->handleException($e);
        }
    }

    /**
    * Login User
    * @param LoginRequest $request
    * @return token & Send Response Message
    * @author Prakash Srivastava
    */
    public function login(LoginRequest $request)
    {
        try {
            $input = $request->all();
            return $this->authRepo->login($input);
        } catch (\Throwable $th) {
            return $this->handleException($th);
        }
    }
}

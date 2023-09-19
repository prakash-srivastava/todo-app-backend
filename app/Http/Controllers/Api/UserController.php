<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repository\User\UserRepositoryInterface;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\UpdateDetailRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    function __construct(UserRepositoryInterface $userRepo)
    {
       $this->userRepo = $userRepo;
    }

    /**
    * LoggedIn User detail
    * @param Request $request
    * @return Send Response Message
    * @author Prakash Srivastava
    */
    public function detail(Request $request)
    {
        try {
            $detail = $this->userRepo->detail();
            return $this->sendResponse(true, "User detail.", $detail, 200);
        } catch (\Throwable $th) {
            return $this->handleException($th);
        }
    }

    /**
    * Change User password
    * @param ChangePasswordRequest $request
    * @return Send Response Message
    * @author Prakash Srivastava
    */
    public function changePassword(ChangePasswordRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->userRepo->changePassword($request);
            DB::commit();
            return $this->sendResponse(true, "Password changed successfully.", [], 200);
        } catch (\Throwable $e) {
            DB::rollBack();
            return $this->handleException($e);
        }
    }

    /**
    * Change User password
    * @param UpdateDetailRequest $request
    * @return Send Response Message
    * @author Prakash Srivastava
    */
    public function update(UpdateDetailRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->only([
                'name', 'email'
            ]);
            $detail = $this->userRepo->update($data);
            DB::commit();
            return $this->sendResponse(true, "User detail updated successfully.", $detail, 200);
        } catch (\Throwable $e) {
            DB::rollBack();
            return $this->handleException($e);
        }
    }
}

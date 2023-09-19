<?php

namespace App\Repository\User;

use App\Models\User;
use App\Repository\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function detail()
    {
        return $this->user->select('id', 'name', 'email', 'created_by')->find(auth()->user()->id);
    }

    public function changePassword($request)
    {
        $data = array();
        $data['password'] = Hash::make($request->password);

        $userObj = $this->user->find(auth()->user()->id);
        $userObj->fill($data);
        $userObj->save();
    }

    public function update($data)
    {
        $userObj = $this->user->find(auth()->user()->id);
        $userObj->fill($data);
        $userObj->save();

        return $this->detail();
    }
}

<?php

namespace App\Repository\User;

interface UserRepositoryInterface
{
    public function detail();
    public function changePassword($request);
}

<?php

namespace App\Repository\Auth;

interface AuthRepositoryInterface
{
    public function register(array $data, $userId);
    public function login(array $data);
}

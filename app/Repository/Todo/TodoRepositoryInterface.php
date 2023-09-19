<?php

namespace App\Repository\Todo;

interface TodoRepositoryInterface
{
    public function list();
    public function detail($todo_id);
    public function store($request);
    public function update($request, $todo_id);
    public function destroy($todo_id);
}

<?php

namespace App\Repository\Todo;

use App\Models\Todo;
use App\Repository\Todo\TodoRepositoryInterface;

class TodoRepository implements TodoRepositoryInterface
{
    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }

    public function list()
    {
        return $this->todo->with('createdByData')->paginate();
    }

    public function detail($todo_id)
    {
        return $this->todo->with('createdByData')->find($todo_id);
    }

    public function store($request)
    {
        $data = $request->all();
        $data['created_by'] = auth()->user()->id;

        return $this->todo->create($data);
    }

    public function update($request, $todo_id)
    {
        $todoObj = $this->todo->find($todo_id);
        if($todoObj) {
            $todoObj->fill($request->all());
            $todoObj->update();
        }

        return $this->detail($todo_id);
    }

    public function destroy($todo_id)
    {
        $this->todo->find($todo_id)->delete();
    }
}

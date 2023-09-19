<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repository\Todo\TodoRepositoryInterface;
use App\Http\Requests\Todo\StoreRequest;
use App\Http\Requests\Todo\DetailRequest;
use App\Http\Requests\Todo\UpdateRequest;
use App\Http\Requests\Todo\DeleteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TodoController extends Controller
{
    function __construct(TodoRepositoryInterface $todoRepo)
    {
       $this->todoRepo = $todoRepo;
    }

    /**
     * Display a listing of the resource.
     */
    public function list()
    {
        return $this->todoRepo->list();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $detail = $this->todoRepo->store($request);
            DB::commit();
            return $this->sendResponse(true, "Task saved successfully.", $detail, 200);
        } catch (\Throwable $e) {
            DB::rollBack();
            return $this->handleException($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function detail(DetailRequest $request)
    {
        try {
            $detail = $this->todoRepo->detail($request->todo_id);
            return $this->sendResponse(true, "Task detail.", $detail, 200);
        } catch (\Throwable $th) {
            return $this->handleException($th);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $detail = $this->todoRepo->update($request, $request->todo_id);
            DB::commit();
            return $this->sendResponse(true, "Task updated successfully.", $detail, 200);
        } catch (\Throwable $e) {
            DB::rollBack();
            return $this->handleException($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->todoRepo->destroy($request->todo_id);
            DB::commit();
            return $this->sendResponse(true, "Task deleted successfully.", [], 200);
        } catch (\Throwable $e) {
            DB::rollBack();
            return $this->handleException($e);
        }
    }
}

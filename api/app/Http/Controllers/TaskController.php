<?php

namespace App\Http\Controllers;

use App\Contracts\TaskServiceInterface;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;

class TaskController extends Controller
{
    public function __construct(private readonly TaskServiceInterface $taskService) {}

    public function index()
    {
        return $this->taskService->index();
    }

    public function store(StoreTaskRequest $request)
    {
        return $this->taskService->store($request->validated());
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        return $this->taskService->update($request->validated(), $task);
    }

    public function destroy(Task $task)
    {
        return $this->taskService->destroy($task);
    }
}

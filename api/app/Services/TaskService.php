<?php

namespace App\Services;

use App\Contracts\TaskServiceInterface;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TaskService implements TaskServiceInterface
{

    public function index(): AnonymousResourceCollection
    {
        return TaskResource::collection(Task::latest()->get());
    }

    public function store(array $task): TaskResource
    {
        $task = Task::create($task);

        return new TaskResource($task);
    }

    public function update(array $data, Task $task): TaskResource
    {
        $task->update($data);

        return new TaskResource($task);
    }

    public function destroy(Task $task): JsonResponse
    {
        $task->delete();

        return response()->json(['message' => 'Task deleted successfully']);
    }
}

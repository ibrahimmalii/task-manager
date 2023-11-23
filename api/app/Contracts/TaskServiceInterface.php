<?php

namespace App\Contracts;

use App\Models\Task;

interface TaskServiceInterface
{
    public function index();
    public function store(array $task);
    public function update(array $data, Task $task);
    public function destroy(Task $task);
}

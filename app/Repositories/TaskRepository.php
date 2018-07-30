<?php namespace App\Repositories;

use App\Task;
use App\Contracts\TaskRepositoryInterface;

class TaskRepository implements TaskRepositoryInterface
{

    protected $task;

    public function __construct(Task $task)
    {
        $this->$task = $task;
    }

    public function find($id)
    {
        return $this->task->find($id);
    }

    public function findBy($attr, $column)
    {
        return $this->task->where($attr, $column);
    }

}
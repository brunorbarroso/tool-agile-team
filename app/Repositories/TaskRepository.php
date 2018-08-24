<?php namespace App\Repositories;

use App\Task;
use App\Contracts\TaskRepositoryInterface;
use App\Repositories\BaseRepository;

class TaskRepository extends BaseRepository implements TaskRepositoryInterface
{

    protected $repository;

    public function __construct(Task $repository)
    {
        $this->repository = $repository;
    }

}
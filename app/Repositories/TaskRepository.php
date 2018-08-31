<?php namespace App\Repositories;

use App\Task;
use App\Contracts\TaskRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Transformers\TaskTransformer;

class TaskRepository extends BaseRepository implements TaskRepositoryInterface
{

    protected $repository;

    public function __construct(Task $repository)
    {
        $this->repository = $repository;
    }

}
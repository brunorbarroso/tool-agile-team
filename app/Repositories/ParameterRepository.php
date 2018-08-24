<?php namespace App\Repositories;

use App\Parameter;
use App\Contracts\ParameterRepositoryInterface;
use App\Repositories\BaseRepository;

class ParameterRepository extends BaseRepository implements ParameterRepositoryInterface
{

    protected $repository;

    public function __construct(Parameter $repository)
    {
        $this->repository = $repository;
    }

}
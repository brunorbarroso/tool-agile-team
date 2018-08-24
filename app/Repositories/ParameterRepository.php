<?php namespace App\Repositories;

use App\Parameter;
use App\Contracts\ParameterRepositoryInterface;

class ParameterRepository extends BaseRepository implements ParameterRepositoryInterface
{

    protected $repository;

    public function __construct(Parameter $repository)
    {
        $this->repository = $repository;
    }

}
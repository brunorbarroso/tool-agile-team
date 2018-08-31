<?php namespace App\Repositories;

use App\Role;
use App\Contracts\RoleRepositoryInterface;
use App\Repositories\BaseRepository;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{

    protected $repository;

    public function __construct(Role $repository)
    {
        $this->repository = $repository;
    }

}
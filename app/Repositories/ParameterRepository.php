<?php namespace App\Repositories;

use App\Parameter;
use App\Contracts\ParameterRepositoryInterface;

class ParameterRepository implements ParameterRepositoryInterface
{

    protected $repository;

    public function __construct(Parameter $repository)
    {
        $this->repository = $repository;
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function create($attrs)
    {
        return $this->repository->create($attrs);
    }

    public function find($id)
    {
        return $this->repository->find($id);
    }

    public function findBy($attr, $column)
    {
        return $this->repository->where($attr, $column);
    }

    public function update($attrs)
    {
        return $this->fill($attrs);
    }

    public function delete($id)
    {
        return $this->repository->destroy($id);
    }

    public function paginate($limit)
    {
        return $this->repository->latest()->paginate($limit);
    }

    public function search($attrs, $limit = false)
    {
        try
        {
            if($limit && is_array($attrs))
            {
                return $this->repository->where($attrs[0], $attrs[1], $attrs[2])->paginate($limit);
            }
        
            return $this->repository->where($attrs[0], $attrs[1], $attrs[2])->get();

        } catch(Exception $ex)
        {
            throw new Exception('Not possible to search information.');
        }
    }

}
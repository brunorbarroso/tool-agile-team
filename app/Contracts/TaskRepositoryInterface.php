<?php namespace App\Contracts;

interface TaskRepositoryInterface
{
    public function all();
    public function create($attrs);
    public function find($id);
    public function findBy($attrs, $column);
    public function update($attrs);
    public function delete($id);
    public function paginate($limit);
    public function search($attrs, $paginate);
    public function whereOrLike(&$model, $attrs);
}
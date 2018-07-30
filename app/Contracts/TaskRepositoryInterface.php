<?php namespace App\Contracts;

interface TaskRepositoryInterface
{
    public function find($id);
    public function findBy($attr, $column);
}
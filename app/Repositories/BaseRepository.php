<?php namespace App\Repositories;

class BaseRepository 
{

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
                return $this->whereOrLike($this->repository, $attrs)
                ->latest()
                ->paginate($limit);
            }

        } catch(Exception $ex)
        {
            throw new Exception('Not possible to search information.');
        }
    }

    public function whereOrLike(&$model, $attrs)
    {

        $query = $model::where(function($q) use ($attrs) {
            foreach($attrs as $key => $attr){
                if($key === 0){
                    $q->where(key($attr), 'LIKE', $attr[key($attr)]);
                }else{
                    $q->orWhere(key($attr), 'LIKE', $attr[key($attr)]);
                }
            }
        });
        
        return $query;

    }

}
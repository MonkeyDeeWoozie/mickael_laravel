<?php

namespace App\Repositories;

abstract class ResourceRepository
{
    protected $project;

    public function getPaginate($n)
    {
        return $this->project->paginate($n);
    }

    public function store(Array $inputs)
    {
        return $this->project->create($inputs);
    }

    public function getById($id)
    {
        return $this->project->findOrFail($id);
    }

    public function update($id, Array $inputs)
    {
        $this->getById($id)->update($inputs);
    }

    public function destroy($id)
    {
        $this->getById($id)->delete();
    }
}
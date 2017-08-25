<?php

namespace App\Repositories;

abstract class Resource2Repository
{
    protected $user;

    public function getPaginate($n)
    {
        return $this->user->paginate($n);
    }

    public function store(Array $inputs)
    {
        return $this->user->create($inputs);
    }

    public function getById($id)
    {
        return $this->user->findOrFail($id);
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
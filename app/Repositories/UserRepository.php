<?php

namespace App\Repositories;

use App\User;

class UserRepository extends ResourceRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    private function save(User $user, Array $inputs)
    {
        $user->name = $inputs['name'];
        $user->email = $inputs['email'];    
        $user->admin = isset($inputs['admin']); 

        $user->save();
    }

    public function store(Array $inputs)
    {
        $user = new User;        
        $user->password = bcrypt($inputs['password']);

        $this->save($user, $inputs);

        return $user;
    }

}
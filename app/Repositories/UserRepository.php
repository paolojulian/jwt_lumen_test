<?php

namespace App\Repositories;

use App\User;
use App\Interfaces\UserInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserInterface
{
    private $model;
    function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getModelAttrib($attrib="")
    {
        if ( ! isset($this->model[$attrib])) {
            abort("Model has no attribute");
        }
        return $this->model[$attrib];
        
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getList($params)
    {
        
    }
    public function getByID($id)
    {
        
    }

    public function createUser($params)
    {
        $this->model->name = $params['name'];
        $this->model->username = $params['username'];
        $this->model->email = $params['email'];
        $this->model->password = Hash::make($params['password']);
        $this->model->usertype = $params['usertype'];
    }

    public function storeUser()
    {
        return $this->model->save();
    }

    public function editUser($id)
    {
        
    }
    public function updateUser($id)
    {
        
    }
    public function deleteUser($id)
    {
        
    }

}
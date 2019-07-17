<?php
namespace App\Interfaces;

use App\User;

interface UserInterface
{
    public function getByID($id);

    public function getList($params);

    public function createUser($params);

    public function storeUser();

    public function editUser($id);

    public function updateUser($id);

    public function deleteUser($id);
}
<?php
/**
 * Created by PhpStorm.
 * User: irsia
 * Date: 12/2/2018
 * Time: 1:12 PM
 */

namespace App\UMS\Contract;


use App\UMS\Entity\User;

interface UserServiceContract
{
    public function add(string $name): User;

    public function delete(int $userId): void;

    public function get(int $userId): User;
}
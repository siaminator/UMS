<?php
/**
 * Created by PhpStorm.
 * User: irsia
 * Date: 12/2/2018
 * Time: 1:13 PM
 */

namespace App\UMS\Contract;


interface MemberServiceContract
{
    public function add(int $groupId, int $userId): int;

    public function remove(int $groupId, int $userId): void;

}
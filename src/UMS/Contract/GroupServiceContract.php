<?php
/**
 * Created by PhpStorm.
 * User: irsia
 * Date: 12/2/2018
 * Time: 1:12 PM
 */

namespace App\UMS\Contract;


use App\UMS\Entity\Group;

interface GroupServiceContract
{
    public function add(): Group;

    public function delete(int $groupId): void;

        public function get(int $groupId): Group;


}
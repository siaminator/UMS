<?php
/**
 * A Service for updating group entities adding/removing
 * Created by PhpStorm.
 * User: Foad
 * Date: 12/01/2018
 * Time: 5:01 PM
 */

namespace App\UMS\Service;

use App\UMS\Contract\GroupServiceContract;
use App\UMS\Entity\Group;
use App\UMS\Exception\NotEmptyGroupException;
use App\UMS\Repository\GroupRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;

class GroupService implements GroupServiceContract
{
    private $groupRepository;
    private $entityManager;

    public function __construct(GroupRepository $groupRepository, EntityManagerInterface $entityManager)
    {
        $this->groupRepository = $groupRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * Adds a group which currently has no attributes!
     *
     * @return Group
     */
    public function add(): Group
    {
        $group = new Group();
        $this->entityManager->persist($group);
        $this->entityManager->flush();
        return $group;
    }

    /**
     * Deletes a group if it has not members
     *
     * @param int $groupId
     * @return void
     * @throws EntityNotFoundException
     */
    public function delete(int $groupId): void
    {
        $group = $this->get($groupId);

        if ($group->hasMember())
            throw new NotEmptyGroupException("The Group has dependent members");

        $this->entityManager->remove($group);
        $this->entityManager->flush();
    }

    /**
     * Get a group entity by its id
     * @param int $groupId
     * @return Group
     * @throws EntityNotFoundException
     */
    public function get(int $groupId): Group
    {
        $group = $this->groupRepository->find($groupId);
        if (is_null($group))
            throw new EntityNotFoundException("Group with id {$groupId} does not exists");

        return $group;
    }
}
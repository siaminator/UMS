<?php
/**
 * A Service for updating group users (members) adding/removing
 *
 * Created by PhpStorm.
 * User: Foad
 * Date: 12/01/2018
 * Time: 5:01 PM
 */

namespace App\UMS\Service;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;

class MemberService
{
    private $groupService;
    private $userService;
    private $entityManager;

    /**
     * MemberService constructor.
     *
     * @param GroupService $groupService
     * @param UserService $userService
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        GroupService $groupService,
        UserService $userService,
        EntityManagerInterface $entityManager
    )
    {
        $this->groupService = $groupService;
        $this->userService = $userService;
        $this->entityManager = $entityManager;
    }

    /**
     * Adds a user to a group by creating a member ManyToMany relation
     *
     * @param int $groupId
     * @param int $userId
     * @return int , The Index of current user in the memmer collection
     * @throws EntityNotFoundException
     */
    public function add(int $groupId, int $userId):int
    {
        $group = $this->groupService->get($groupId);
        $user = $this->userService->get($userId);

        $group->addMember($user);

        $this->entityManager->persist($group);
        $this->entityManager->flush();

        return (int) $group->getMember()->indexOf($user);
    }

    /**
     * Removes a user from a group by deleting the member relationship
     * @param int $groupId
     * @param int $userId
     * @throws EntityNotFoundException
     */
    public function remove(int $groupId, int $userId)
    {
        $group = $this->groupService->get($groupId);
        $user = $this->userService->get($userId);

        $group->removeMember($user);

        $this->entityManager->persist($group);
        $this->entityManager->flush();
    }
}
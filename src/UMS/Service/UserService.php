<?php
/**
 * A Service for Adding/Removing user entities
 *
 * Created by PhpStorm.
 * User: Foad
 * Date: 12/01/2018
 * Time: 5:01 PM
 */

namespace App\UMS\Service;

use App\UMS\Contract\UserServiceContract;
use App\UMS\Entity\User;
use App\UMS\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;

class UserService implements UserServiceContract
{
    private $userRepository;
    private $entityManager;

    public function __construct(UserRepository $userRepository, EntityManagerInterface $entityManager)
    {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * Add a user entity
     *
     * @param string $name
     * @return User
     */
    public function add(string $name): User
    {
        $user = new User();
        $user->setName($name);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        return $user;
    }

    /**
     * Delete a user entity by Id
     *
     * @param int $userId
     * @return void
     * @throws EntityNotFoundException
     */
    public function delete(int $userId): void
    {
        $user = $this->userRepository->find($userId);
        if (is_null($user))
            throw new EntityNotFoundException("User with id {$userId} does not exists");

        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }

    /**
     * Get a user entity by Id
     * @param int $userId
     * @return User
     * @throws EntityNotFoundException
     */
    public function get(int $userId): User
    {
        $user = $this->userRepository->find($userId);
        if (is_null($user))
            throw new EntityNotFoundException("User with id {$userId} does not exists");

        return $user;
    }
}
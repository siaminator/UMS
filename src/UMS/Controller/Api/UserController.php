<?php

namespace App\UMS\Controller\Api;

use App\UMS\Contract\UserServiceContract;
use Doctrine\ORM\EntityNotFoundException;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ums/users")
 */
class UserController extends FOSRestController
{
    private $userService;
    private $request;

    /**
     * UserController constructor.
     *
     * @param UserServiceContract $userService
     * @param RequestStack $request
     */
    public function __construct(UserServiceContract $userService, RequestStack  $request)
    {
        $this->userService = $userService;
        $this->request = $request->getCurrentRequest();
    }

    /**
     * Adds a user
     *
     * @Rest\Post("")
     * @return View
     */
    public function create(): View
    {
        $name = $this->request->get('name');

        $user = $this->userService->add($name);

        return View::create($user, Response::HTTP_CREATED);
    }

    /**
     * Deletes a User by Id
     *
     * @Route("/{userId}", methods={"DELETE"}, requirements={"userId"="\d+"})
     * @param int $userId
     * @return View
     * @throws EntityNotFoundException
     */
    public function delete(int $userId): View
    {
        $this->userService->delete($userId);

        return View::create(null, Response::HTTP_ACCEPTED);
    }
}

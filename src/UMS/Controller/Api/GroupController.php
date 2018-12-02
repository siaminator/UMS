<?php

namespace App\UMS\Controller\Api;

use App\UMS\Contract\GroupServiceContract;
use App\UMS\Exception\NotEmptyGroupException;
use Doctrine\ORM\EntityNotFoundException;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ums/groups")
 */
class GroupController extends FOSRestController
{
    private $groupService;

    /**
     * GroupController constructor.
     *
     * GroupController constructor.
     * @param GroupServiceContract $groupService
     */
    public function __construct(GroupServiceContract $groupService)
    {
        $this->groupService = $groupService;
    }

    /**
     * Creates a Group
     *
     * @Rest\Post("")
     * @return View
     */
    public function create(): View
    {
        $group = $this->groupService->add();

        return View::create($group, Response::HTTP_CREATED);
    }

    /**
     * Deletes a Group by its id
     *
     * @Route("/{groupId}", methods={"DELETE"})
     * @param int $groupId
     * @return View
     * @throws EntityNotFoundException
     */
    public function delete(int $groupId): View
    {
        try {
            $this->groupService->delete($groupId);
        } catch (NotEmptyGroupException $e) {
            throw new ConflictHttpException("The Group has dependent members");
        }

        return View::create(null, Response::HTTP_ACCEPTED);
    }

}

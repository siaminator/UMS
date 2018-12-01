<?php

namespace App\UMS\Controller\Api;

use App\UMS\Service\MemberService;
use Doctrine\ORM\EntityNotFoundException;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ums/groups/{groupId}/users")
 */
class GroupUserController extends FOSRestController
{

    private $memberService;
    private $request;

    /**
     * GroupUserController constructor.
     *
     * @param MemberService $memberService
     * @param RequestStack $request
     */
    public function __construct(MemberService $memberService, RequestStack $request)
    {
        $this->memberService = $memberService;
        $this->request = $request->getCurrentRequest();
    }


    /**
     * Adds a user to a group if not already added
     *
     * @Route("", methods={"POST"})
     * @param int $groupId
     * @return View, containing the index of the created member (this is just for the
     * sake of an informative response and is of no use !
     * @throws EntityNotFoundException
     */
    public function assignUser(int $groupId): View
    {
        $userId = (int)$this->request->get('userId');

        $memberIndex = $this->memberService->add($groupId, $userId);

        return View::create(['id' => $memberIndex], Response::HTTP_CREATED);
    }

    /**
     * Removed a user from the group if exists
     *
     * @Route("/{userId}", methods={"DELETE"})
     * @param int $groupId
     * @param int $userId
     * @return View
     * @throws EntityNotFoundException
     */
    public function unAssignUser(int $groupId, int $userId): View
    {
        $this->memberService->remove($groupId, $userId);

        return View::create(null, Response::HTTP_ACCEPTED);
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: nooneexpectme
 * Date: 17/05/18
 * Time: 13:35
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Club;
use AppBundle\Form\ClubType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ClubController
 * @package AppBundle\Controller
 */
class ClubController extends Controller
{
    /**
     * List clubs
     * @param Request $req
     * @return Response
     * @Route("/admin/clubs", name="admin_club_list")
     * @Method("GET")
     */
    public function adminList(Request $req): Response
    {
        return $this->render('club/admin/list.html.twig', [
            'create_form' => $this->createForm(ClubType::class)->createView(),
            'clubs' => $this->getDoctrine()->getManager()->getRepository(Club::class)->findAll()
        ]);
    }

    /**
     * Create a club
     * @param Request $req
     * @return Response
     * @Route("/admin/club/create", name="admin_club_create")
     * @Method("POST")
     */
    public function adminCreate(Request $req): Response
    {
        $club = new Club();
        $form = $this->createForm(ClubType::class, $club);
        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($club);
            $em->flush();
            $this->addFlash('success','Le club a été ajouté');
        }

        return $this->redirectToRoute('admin_club_list');
    }

    /**
     *
     * @param Club $club
     * @param Request $req
     * @return Response
     */
    public function adminEdit(Club $club, Request $req): Response
    {

    }
}
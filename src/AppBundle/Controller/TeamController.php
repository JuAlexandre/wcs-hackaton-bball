<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Team;
use AppBundle\Form\TeamType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class TeamController
 * @package AppBundle\Controller
 */
class TeamController extends Controller
{
    /**
     * Lists all team entities.
     * @Route("/admin/teams", name="admin_team_list")
     * @Method("GET")
     * @return Response
     */
    public function adminList(): Response
    {
        return $this->render('team/admin/list.html.twig', [
            'create_form' => $this->createForm(TeamType::class)->createView(),
            'teams' => $this->getDoctrine()->getRepository(Team::class)->findAll(),
        ]);
    }

    /**
     * Creates a new team entity.
     * @param Request $req
     * @Route("/admin/team/create", name="admin_team_create")
     * @Method("POST")
     * @return Response
     */
    public function adminCreate(Request $req): Response
    {
        $team = new Team();
        $form = $this->createForm(TeamType::class, $team);
        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($team);
            $em->flush();
            $this->addFlash('success', "L'équipe a été crée");
        }

        return $this->redirectToRoute('admin_team_list');
    }

    /**
     * Edit a team
     * @param Team $team
     * @param Request $req
     * @return Response
     * @Route("/admin/team/{team}/edit", name="admin_team_edit")
     * @Method({ "POST", "GET" })
     */
    public function adminEdit(Team $team, Request $req): Response
    {
        $form = $this->createForm(TeamType::class, $team);
        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', "L'équipe a été modifiée");
            return $this->redirectToRoute('admin_team_list');
        }

        return $this->render('team/admin/edit.html.twig', [
            'team' => $team,
            'edit_form' => $form->createView(),
        ]);
    }

    /**
     * Delete a team
     * @param Team $team
     * @param Request $req
     * @return Response
     * @Route("/admin/team/{team}/delete", name="admin_team_delete")
     */
    public function adminDelete(Team $team, Request $req): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($team);
        $em->flush();
        $this->addFlash('success', 'Equipe supprimée');
        return $this->redirectToRoute('admin_team_list');
    }

    /**
     * @return Response
     * @Route("/teams", name="team_list")
     */
    public function list(): Response
    {
        return $this->render('team/list.html.twig', [
            'teams' => $this->getDoctrine()->getRepository(Team::class)->findAll(),
        ]);
    }

}

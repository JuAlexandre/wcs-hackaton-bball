<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Stadium;
use AppBundle\Entity\Team;
use AppBundle\Form\StadiumType;
use AppBundle\Form\TeamType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class StadiumController
 * @package AppBundle\Controller
 */
class StadiumController extends Controller
{
    /**
     * Lists all stadium entities.
     * @Route("/admin/stadiums", name="admin_stadium_list")
     * @Method("GET")
     * @return Response
     */
    public function adminList(): Response
    {
        return $this->render('stadium/admin/list.html.twig', [
            'create_form' => $this->createForm(StadiumType::class)->createView(),
            'stadiums' => $this->getDoctrine()->getRepository(Stadium::class)->findAll(),
        ]);
    }

    /**
     * Creates a new stadium entity.
     * @param Request $req
     * @Route("/admin/stadium/create", name="admin_stadium_create")
     * @Method("POST")
     * @return Response
     */
    public function adminCreate(Request $req): Response
    {
        $stadium = new Stadium();
        $form = $this->createForm(StadiumType::class, $stadium);
        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($stadium);
            $em->flush();
            $this->addFlash('success', "Le stade a été créé");
        }

        return $this->redirectToRoute('admin_stadium_list');
    }

    /**
     * Edit a stadium
     * @param Stadium $stadium
     * @param Request $req
     * @return Response
     * @Route("/admin/stadium/{stadium}/edit", name="admin_stadium_edit")
     * @Method({ "POST", "GET" })
     */
    public function adminEdit(Stadium $stadium, Request $req): Response
    {
        $form = $this->createForm(StadiumType::class, $stadium);
        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', "Le stade a été modifié");
            return $this->redirectToRoute('admin_stadium_list');
        }

        return $this->render('stadium/admin/edit.html.twig', [
            'stadium' => $stadium,
            'edit_form'=>$form->createView(),
        ]);
    }

    /**
     * Delete a stadium
     * @param Stadium $stadium
     * @param Request $req
     * @return Response
     * @Route("/admin/stadium/{stadium}/delete", name="admin_stadium_delete")
     */
    public function adminDelete(Stadium $stadium, Request $req): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($stadium);
        $em->flush();
        $this->addFlash('success', 'Stade supprimé');
        return $this->redirectToRoute('admin_stadium_list');
    }
}

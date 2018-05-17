<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Pool;
use AppBundle\Form\PoolType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Pool controller.
 */
class PoolController extends Controller
{
    /**
     * Lists all pool entities.
     * @param Request $req
     * @return Response
     * @Route("/admin/pool/", name="admin_pool_list")
     * @Method("GET")
     */
    public function adminList(Request $req): Response
    {
        return $this->render('pool/admin/list.html.twig', [
            'create_form' => $this->createForm(PoolType::class)->createView(),
            'pools' => $this->getDoctrine()->getRepository(Pool::class)->findAll()
        ]);
    }

    /**
     * Creates a new pool entity.
     * @param Request $req
     * @return Response
     * @Route("/admin/pool/new", name="admin_pool_create")
     * @Method({"GET", "POST"})
     */
    public function adminCreate(Request $req): Response
    {
        $pool = new Pool();
        $form = $this->createForm(PoolType::class, $pool);
        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pool);
            $em->flush();
            $this->addFlash('success', 'Poule créée');
        }

        return $this->redirectToRoute('admin_pool_list');
    }

    /**
     * Displays a form to edit an existing pool entity.
     * @param Pool $pool
     * @param Request $req
     * @return Response
     * @Route("/admin/pool/{id}/edit", name="admin_pool_edit")
     * @Method({"GET", "POST"})
     */
    public function adminEdit(Pool $pool, Request $req): Response
    {
        $editForm = $this->createForm('AppBundle\Form\PoolType', $pool);
        $editForm->handleRequest($req);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('admin_pool_edit', array('id' => $pool->getId()));
        }

        return $this->render('pool/admin/edit.html.twig', [
            'edit_form' => $editForm->createView(),
            'pool' => $pool
        ]);
    }

    /**
     * Deletes a pool entity.
     * @param Pool $pool
     * @param Request $req
     * @return Response
     * @Route("/admin/pool/{pool}/delete", name="admin_pool_delete")
     * @Method("GET")
     */
    public function adminDelete(Pool $pool, Request $req): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($pool);
        $em->flush();
        $this->addFlash('success', 'Poule supprimée');
        return $this->redirectToRoute('admin_pool_list');
    }
}

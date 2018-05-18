<?php
/**
 * Created by PhpStorm.
 * User: wilder16
 * Date: 17/05/18
 * Time: 13:53
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Game;
use AppBundle\Entity\GameTeamStats;
use AppBundle\Entity\Team;
use AppBundle\Form\GameType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/***
 * Class GameController
 * @package AppBundle\Controller
 */
class GameController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/admin/games", name="admin_game_list")
     * @Method("GET")
     */
    public function adminList(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $games = $em->getRepository(Game::class)->findAll();

        return $this->render('game/admin/list.html.twig', [
            'create_form' => $this->createForm(GameType::class)->createView(),
            'games' => $games,
        ]);
    }

    /**
     * @param Request $req
     * @return Response
     * @Route("/admin/game/create", name="admin_game_create")
     * @Method("POST")
     */
    public function adminCreate(Request $req): Response
    {
        $game = new Game();

        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($game);
            $em->flush();
        }

        return $this->redirectToRoute('admin_game_list');
    }

    /**
     * @param Game $game
     * @param Request $req
     * @return Response
     * @Route("/admin/game/{game}/edit", name="admin_game_edit")
     * @Method({"GET", "POST"})
     */
    public function adminEdit(Game $game, Request $req): Response
    {
        $editForm = $this->createForm(GameType::class, $game);
        $editForm->handleRequest($req);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Match modifié');
            return $this->redirectToRoute('admin_game_list');
        }

        return $this->render('game/admin/edit.html.twig', [
            'edit_form' => $editForm->createView(),
            'game' => $game
        ]);
    }
}
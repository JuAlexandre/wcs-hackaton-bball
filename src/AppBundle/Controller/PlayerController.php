<?php
/**
 * Created by PhpStorm.
 * User: wilder12
 * Date: 17/05/18
 * Time: 15:14
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Player;
use AppBundle\Form\PlayerType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PlayerController
 * @package AppBundle\Controller
 */
class PlayerController extends Controller
{
    /**
     * List players.
     *
     * @Route("/admin/players", name="admin_player_list")
     * @Method("GET")
     *
     * @param Request $req
     * @return Response
     */
    public function adminList(Request $req): Response
    {
        return $this->render('player/admin/list.html.twig', [
            'create_form' => $this->createForm(PlayerType::class)->createView(),
            'players' => $this->getDoctrine()->getRepository(Player::class)->findAll(),
        ]);
    }

    /**
     * Create player.
     *
     * @Route("/admin/player/create", name="admin_player_create")
     * @Method("POST")
     *
     * @param Request $req
     * @return Response
     */
    public function adminCreate(Request $req): Response
    {
        $player = new Player();
        $form = $this->createForm(PlayerType::class, $player);
        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($player);
            $em->flush();
            $this->addFlash('success', 'Le joueur a été ajouté');
        }
        return $this->redirectToRoute('admin_player_list');
    }

    /**
     * Edit player
     * @param Player $player
     * @param Request $req
     * @return Response
     * @Route("/admin/player/{player}/edit", name="admin_player_edit")
     * @Method({ "POST", "GET" })
     */
    public function adminEdit(Player $player, Request $req): Response
    {
        $form = $this->createForm(PlayerType::class, $player);
        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Le joueur a été modifié');

            return $this->redirectToRoute('admin_player_list');
        }

        return $this->render('player/admin/edit.html.twig', [
            'edit_form' => $form->createView(),
            'player' => $player,
        ]);
    }

    /**
     * Delete a player
     * @param Player $player
     * @return Response
     * @Route("/admin/player/{player}/delete", name="admin_player_delete")
     * @Method("GET")
     */
    public function adminDelete(Player $player): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($player);
        $em->flush();
        $this->addFlash('success', 'Le joueur a été supprimé');

        return $this->redirectToRoute('admin_player_list');
    }

    /**
     * @return Response
     * @Route("/players", name="player_list")
     */
    public function list(): Response
    {
        return $this->render('player/list.html.twig', [
            'players' => $this->getDoctrine()->getRepository(Player::class)->findAll(),
        ]);
    }
}
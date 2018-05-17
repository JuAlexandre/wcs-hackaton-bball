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
}
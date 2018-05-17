<?php
/**
 * Created by PhpStorm.
 * User: wilder16
 * Date: 17/05/18
 * Time: 13:53
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Game;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
    public function adminList()
    {
        $em = $this->getDoctrine()->getManager();
        $games = $em->getRepository(Game::class)->findAll();

        return $this->render('admin/game/list.html.twig', [
           'games' => $games,
        ]);
    }
}
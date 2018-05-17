<?php
/**
 * Created by PhpStorm.
 * User: wilder16
 * Date: 17/05/18
 * Time: 13:53
 */

namespace AppBundle\Controller;

use AppBundle\Entity\AbstractGame;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/***
 * Class GameController
 * @package AppBundle\Controller
 * @Route("admin/games", name="admin_game_list")
 * @Method("GET")
 */
class GameController extends Controller
{
    public function adminList()
    {
        $em = $this->getDoctrine()->getManager();
        $games = $em->getRepository(AbstractGame::class)->findAll();

        return $this->render('admin/game/index.html.twig', [
           'games' => $games,
        ]);
    }
}
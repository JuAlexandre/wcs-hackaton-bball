<?php
/**
 * Created by PhpStorm.
 * User: nooneexpectme
 * Date: 17/05/18
 * Time: 12:24
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AdminController
 * @package AppBundle\Controller
 */
class AdminController extends Controller
{
    /**
     * Admin home index
     * @param Request $req
     * @return Response
     * @Route("/admin/", name="admin_index")
     * @Method("GET")
     */
    public function indexAction(Request $req): Response
    {
        return $this->render('admin/index.html.twig');
    }
}
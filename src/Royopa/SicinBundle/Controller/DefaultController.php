<?php

namespace Royopa\SicinBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Default controller.
 *
 * @Route("/")
 */
class DefaultController extends Controller
{

    /**
     * Default Page.
     *
     * @Route("/", name="home")
     * @Method("GET")
     * @Template("RoyopaSicinBundle:Default:base.html.twig")
     */
    public function indexAction()
    {
        return array(

        );
    }

    /**
     * Default Page.
     *
     * @Route("/parametros", name="parametros")
     * @Method("GET")
     * @Template("RoyopaSicinBundle:Default:parametros.html.twig")
     */
    public function parametrosAction()
    {
        return array(

        );
    }
}

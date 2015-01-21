<?php

namespace Royopa\SicinBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Royopa\SicinBundle\Form\ConsultaPosicaoSinteticaType;

/**
 * Posicao controller.
 *
 * @Route("/posicao_sintetica")
 * @Security("has_role('ROLE_ADMIN')")
 */
class PosicaoSinteticaController extends Controller
{
    /**
     * Lists all Posicao sintética entities.
     *
     * @Route("/sintetica", name="posicao_sintetica")
     * @Method({"POST","GET"})
     * @Template("RoyopaSicinBundle:Posicao:lista_sintetica.html.twig")
     */
    public function sinteticaIndexAction(Request $request)
    {
        $form = $this->createForm(
            new ConsultaPosicaoSinteticaType(),
            null,
            array(
                'action' => $this->generateUrl('posicao_sintetica'),
                'method' => 'POST',
            )
        );

        $form->handleRequest($request);

        if (!$form->isValid()) {
            return $this->render(
                'RoyopaSicinBundle:Form:form_consulta_posicao_sintetica.html.twig',
                array(
                    'title'       => 'Consulta posição sintética de investimentos',
                    'subtitle' => 'Utilize o formulário abaixo para consultar a posição sintética de investimentos.',
                    'form'     => $form->createView(),
                )
            );
        }

        $data = $form->getData();
        $ano  = $data['ano'];
        $mes = $data['mes'];

        $em = $this->getDoctrine()->getManager();
        $entities =
            $em
                ->getRepository('RoyopaSicinBundle:Posicao')
                ->findPosicaoSintetica($mes, $ano);

        return array(
            'ano'      => $ano,
            'mes'      => $mes,
            'entities' => $entities,
            );
    }
}

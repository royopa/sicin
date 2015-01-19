<?php

namespace Royopa\SicinBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * ImportacaoBmfBovespa controller.
 *
 * @Route("/importacao_bmfbovespa")
 * @Security("has_role('ROLE_ADMIN')")
 */
class ImportacaoBmfBovespaController extends ImportacaoController
{
    /**
     * Importa o extrato da bmf bovespa com a posição
     *
     * @Route("/", name="importacao_bmfbovespa_new")
     * @Method({"POST","GET"})
     * @Template()
     */
    public function importacaoBmfBovespaIndexAction(Request $request)
    {
        return $this->importacaoIndexAction(
            $request,
            'importacao_bmfbovespa_new',
            'RoyopaSicinBundle:Importacao:importacao_bmfbovespa.html.twig',
            'bmfbovespa'
        );
    }
}

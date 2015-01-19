<?php

namespace Royopa\SicinBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Importação controller.
 *
 * @Route("/importacao_tesouro_direto")
 * @Security("has_role('ROLE_ADMIN')")
 */
class ImportacaoTesouroDiretoController extends ImportacaoController
{
    /**
     * Lists all AtivoTipo entities.
     *
     * @Route("/", name="importacao_tesouro_direto_new")
     * @Method({"POST","GET"})
     * @Template()
     */
    public function importacaoTesouroDiretoIndexAction(Request $request)
    {
        return $this->importacaoIndexAction(
            $request,
            'importacao_tesouro_direto_new',
            'RoyopaSicinBundle:Importacao:index.html.twig',
            'tesouro_direto'
        );
    }
}

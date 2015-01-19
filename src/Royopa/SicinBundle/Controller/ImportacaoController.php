<?php

namespace Royopa\SicinBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Royopa\SicinBundle\Form\ImportacaoType;
use Royopa\SicinBundle\Entity\InstituicaoFinanceira;
use Royopa\SicinBundle\Entity\Ativo;

/**
 * Importacao controller.
 *
 * @Security("has_role('ROLE_ADMIN')")
 */
class ImportacaoController extends Controller
{
    public function getIf($if, $em)
    {
        //localiza a if título
        $if = $em->getRepository('RoyopaSicinBundle:InstituicaoFinanceira')
            ->findOneByNome($if);

        if (!$if) {
            throw $this->createNotFoundException('Unable to find if entity.');
        }

        return $if;
    }

    public function getAtivo($ativo, $em)
    {
        //título/ativo
        $ativo = $em->getRepository('RoyopaSicinBundle:Ativo')
            ->findOneByCodigo($ativo);

        if (!$ativo) {
            throw $this->createNotFoundException('Ativo '.$ativo.' não cadastrado.');
        }

        return $ativo;
    }

    public function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    public function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads';
    }

    public function getCreateForm($action = '')
    {
        $form = $this->createForm(
            new ImportacaoType(),
            null,
            array(
                'action' => $this->generateUrl($action),
                'method' => 'POST',
            )
        );

        return $form;
    }
}

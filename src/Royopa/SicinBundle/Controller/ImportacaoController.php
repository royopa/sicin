<?php

namespace Royopa\SicinBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Royopa\SicinBundle\Entity\Posicao;
use Royopa\SicinBundle\Form\ImportacaoType;

/**
 * Importação controller.
 *
 * @Route("/importacao")
 * @Security("has_role('ROLE_ADMIN')")
 */
class ImportacaoController extends Controller
{
    /**
     * Lists all AtivoTipo entities.
     *
     * @Route("/", name="importacao_new")
     * @Method({"POST","GET"})
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(new ImportacaoType(), null, array(
            'action' => $this->generateUrl('importacao_new'),
            'method' => 'POST',
        ));

        $form->handleRequest($request);

        if (!$form->isValid()) {
            return $this->render('RoyopaSicinBundle:Importacao:index.html.twig', array(
                'title'    => 'Importação de extrato mensal',
                'subtitle' => 'Utilize o formulário abaixo para importar um arquivo de extrato.',
                'form'     => $form->createView(),
            ));
        }

        $uploadedFile = $form['attachment']->getData();

        $uploadedFile->move(
            $this->getUploadRootDir(),
            'extrato.' . $uploadedFile->guessExtension()
        );

        //verifica o mime/type do arquivo
        if ($uploadedFile->getMimeType() != 'text/csv') {
            throw $this->createNotFoundException('Arquivo inválido. Utilize arquivos csv.');
        }

        return new Response(var_dump($uploadedFile));
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads';
    }
}

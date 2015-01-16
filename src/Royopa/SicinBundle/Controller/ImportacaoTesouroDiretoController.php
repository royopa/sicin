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
use Ddeboer\DataImport\Reader\CsvReader;

/**
 * Importação controller.
 *
 * @Route("/importacao")
 * @Security("has_role('ROLE_ADMIN')")
 */
class ImportacaoTesouroDiretoController extends Controller
{
    /**
     * Lists all AtivoTipo entities.
     *
     * @Route("/", name="importacao_tesouro_direto_new")
     * @Method({"POST","GET"})
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(new ImportacaoType(), null, array(
            'action' => $this->generateUrl('importacao_tesouro_direto_new'),
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

        $endereco = $this->getUploadRootDir().'/extrato.' . $uploadedFile->guessExtension();

        $file = $uploadedFile->move(
            $this->getUploadRootDir(),
            'extrato.' . $uploadedFile->guessExtension()
        );

        //verifica o mime/type do arquivo
        if ($file->getMimeType() != 'text/plain') {
            throw $this->createNotFoundException('Arquivo inválido. Utilize arquivos csv.');
        }

        //abre o arquivo texto e trabalha com ele
        $file = new \SplFileObject($endereco);
        $reader = new CsvReader($file);

        //data,if,titulo,ant,c,d,bloq,atual,origem,bruto_atual,ir,iof,bvmf,ag_cust,liquido,no_periodo,analitico
        $reader->setHeaderRowNumber(0);

        $em = $this->getDoctrine()->getManager();

        foreach ($reader as $row) {

            if (!$row) {
                continue;
            }

            //localiza a if título
            $if = $em->getRepository('RoyopaSicinBundle:InstituicaoFinanceira')->findOneByNome($row['if']);

            if (!$if) {
                throw $this->createNotFoundException('Unable to find if entity.');
            }

            //título/ativo
            $ativo = $em->getRepository('RoyopaSicinBundle:Ativo')->findOneByCodigo($row['titulo']);

            if (!$ativo) {
                
                throw $this->createNotFoundException('Ativo ' . $row['titulo'] . ' não cadastrado.');
            }

            //se não existir nenhuma posição já cadastrada com os mesmos dados, cadastra nova posição
            $posicao = new Posicao();
            //data
            $posicao->setDataReferencia(new \DateTime($row['data']));
            //if
            $posicao->setInstituicaoFinanceira($if);
            //ativo
            $posicao->setAtivo($ativo);
            //quantidade
            $row['atual'] = str_replace(',', '.', $row['atual']);
            $posicao->setQuantidade($row['atual']);
            //valor custo
            $row['origem'] = str_replace(',', '.', $row['origem']);
            $posicao->setValorBrutoTotal($row['origem']);
            //liquido
            $row['liquido'] = str_replace(',', '.', $row['liquido']);
            $posicao->setValorLiquidoTotal($row['liquido']);

            //persiste no banco de dados
            $em->persist($posicao);
            $em->flush();
        }

        return new Response(var_dump($reader));
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

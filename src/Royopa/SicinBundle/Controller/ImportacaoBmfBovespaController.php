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
use Royopa\SicinBundle\Entity\InstituicaoFinanceira;
use Royopa\SicinBundle\Entity\Ativo;
use Ddeboer\DataImport\Reader\CsvReader;

/**
 * ImportacaoBmfBovespa controller.
 *
 * @Route("/importacao_bmfbovespa")
 * @Security("has_role('ROLE_ADMIN')")
 */
class ImportacaoBmfBovespaController extends Controller
{
    /**
     * Importa o extrato da bmf bovespa com a posição
     *
     * @Route("/", name="importacao_bmfbovespa_new")
     * @Method({"POST","GET"})
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(
            new ImportacaoType(),
            null,
            array(
                'action' => $this->generateUrl('importacao_bmfbovespa_new'),
                'method' => 'POST',
            )
        );

        $form->handleRequest($request);

        if (!$form->isValid()) {
            return $this->render(
                'RoyopaSicinBundle:Importacao:importacao_bmfbovespa.html.twig',
                array(
                    'title'    => 'Importação de extrato mensal BM&F Bovespa',
                    'subtitle' => 'Utilize o formulário abaixo para importar um arquivo de extrato.',
                    'form'     => $form->createView(),
                )
            );
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

            //procura a if
            $if = $this->getIf($row['if'], $em);
            
            $ativo = $this->getAtivo($row['titulo'], $em);

            //popula a posição
            $posicao = $this->populatePosicao($row, new Posicao(), $if, $ativo);

            //persiste no banco de dados
            $em->persist($posicao);
            $em->flush();

            var_dump($row);
            echo '<p>Salvo</p>';
        }

        $this->get('session')->getFlashBag()->add(
            'notice',
            'Posições importadas com sucesso!'
        );

        return $this->redirect(
            $this->generateUrl(
                'posicao'
            )
        );
    }

    protected function getIf($if, $em)
    {
        //localiza a if título
        $if = $em->getRepository('RoyopaSicinBundle:InstituicaoFinanceira')
            ->findOneByNome($if);

        if (!$if) {
            throw $this->createNotFoundException('Unable to find if entity.');
        }

        return $if;
    }

    protected function getAtivo($ativo, $em)
    {
        //título/ativo
        $ativo = $em->getRepository('RoyopaSicinBundle:Ativo')
            ->findOneByCodigo($ativo);

        if (!$ativo) {
            throw $this->createNotFoundException('Ativo ' . $ativo . ' não cadastrado.');
        }

        return $ativo;
    }

    protected function populatePosicao(
        $row,
        Posicao $posicao,
        InstituicaoFinanceira $if,
        Ativo $ativo
    ) {
        //data
        $posicao->setDataReferencia(new \DateTime($row['data']));
        //if
        $posicao->setInstituicaoFinanceira($if);
        //ativo
        $posicao->setAtivo($ativo);
        //quantidade
        $posicao->setQuantidade((int) $row['quantidade']);
        //valor_mercado
        $posicao->setValorMercado((float) $row['valor_mercado']);
        $posicao->setValorBrutoTotal((float) $row['valor_mercado']);
        $posicao->setValorLiquidoTotal((float) $row['valor_mercado']);
        //valor_provento
        $posicao->setValorProvento($row['valor_provento']);

        return $posicao;
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

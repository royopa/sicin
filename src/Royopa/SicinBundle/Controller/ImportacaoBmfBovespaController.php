<?php

namespace Royopa\SicinBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Royopa\SicinBundle\Entity\Posicao;
use Royopa\SicinBundle\Entity\InstituicaoFinanceira;
use Royopa\SicinBundle\Entity\Ativo;
use Ddeboer\DataImport\Reader\CsvReader;

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
        $form = $this->getCreateForm('importacao_bmfbovespa_new');

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
            //procura o ativo
            $ativo = $this->getAtivo($row['titulo'], $em);
            //popula a posição
            $posicao = $this->populatePosicao($row, new Posicao(), $if, $ativo);

            //persiste no banco de dados
            $em->persist($posicao);
            $em->flush();
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
}

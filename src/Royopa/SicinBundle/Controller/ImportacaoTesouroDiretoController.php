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
        $form = $this->getCreateForm('importacao_tesouro_direto_new');

        $form->handleRequest($request);

        if (!$form->isValid()) {
            return $this->render(
                'RoyopaSicinBundle:Importacao:index.html.twig',
                array(
                    'title'    => 'Importação de extrato mensal',
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
        $row['atual'] = str_replace(',', '.', $row['atual']);
        $posicao->setQuantidade((float) $row['atual']);
        //valor custo
        $row['origem'] = str_replace(',', '.', $row['origem']);
        $posicao->setValorBrutoTotal((float)$row['origem']);
        $posicao->setValorMercado((float) $row['origem']);
        //liquido
        $row['liquido'] = str_replace(',', '.', $row['liquido']);
        $posicao->setValorLiquidoTotal((float)$row['liquido']);

        return $posicao;
    }
}

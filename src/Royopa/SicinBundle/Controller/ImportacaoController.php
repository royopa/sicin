<?php

namespace Royopa\SicinBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Royopa\SicinBundle\Form\ImportacaoType;
use Royopa\SicinBundle\Entity\InstituicaoFinanceira;
use Royopa\SicinBundle\Entity\Ativo;
use Royopa\SicinBundle\Entity\Posicao;
use Ddeboer\DataImport\Reader\CsvReader;

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

    public function importacaoIndexAction(
        Request $request,
        $route = '',
        $template = '',
        $tipoExtrato = ''
    ) {
        $form = $this->getCreateForm($route);

        $form->handleRequest($request);

        if (!$form->isValid()) {
            return $this->render(
                $template,
                array(
                    'title'    => 'Importação de extrato mensal',
                    'subtitle' => 'Utilize o formulário abaixo para importar um arquivo de extrato.',
                    'form'     => $form->createView(),
                )
            );
        }

        //valida o arquivo que foi feito o upload e pega o endereço salvo
        $endereco = $this->validaArquivoExtrato($form['attachment']->getData());

        //abre o arquivo texto e trabalha com ele
        $reader = $this->readArquivoExtrato($endereco);

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
            if ($tipoExtrato == 'tesouro_direto') {
                $posicao = $this->populatePosicaoTesouroDireto($row, new Posicao(), $if, $ativo);
            }

            if ($tipoExtrato == 'bmfbovespa') {
                $posicao = $this->populatePosicaoBmfBovespa($row, new Posicao(), $if, $ativo);
            }

            if (!$this->checkPosicaoExists($posicao, $em)) {
                //persiste no banco de dados
                $em->persist($posicao);
                $em->flush();
            }
        }

        $this->setMensagemSucesso();

        return $this->redirectPaginaSucesso();
    }

    protected function validaArquivoExtrato($uploadedFile)
    {
        $endereco = $this->getUploadRootDir().'/extrato.'.$uploadedFile->guessExtension();

        $file = $uploadedFile->move(
            $this->getUploadRootDir(),
            'extrato.'.$uploadedFile->guessExtension()
        );

        //verifica o mime/type do arquivo
        if ($file->getMimeType() != 'text/plain') {
            throw $this->createNotFoundException('Arquivo inválido. Utilize arquivos csv.');
        }

        return $endereco;
    }

    protected function readArquivoExtrato($endereco = '')
    {
        $file = new \SplFileObject($endereco);
        $reader = new CsvReader($file);
        $reader->setHeaderRowNumber(0);

        return $reader;
    }

    protected function redirectPaginaSucesso()
    {
        return $this->redirect(
            $this->generateUrl(
                'posicao'
            )
        );
    }

    protected function setMensagemSucesso()
    {
        return $this->get('session')->getFlashBag()->add(
            'notice',
            'Posições importadas com sucesso!'
        );
    }

    protected function checkPosicaoExists(Posicao $posicao, $em)
    {
        //localiza a posição
        $entity = $em->getRepository('RoyopaSicinBundle:Posicao')
            ->findBy(
                [
                'instituicaoFinanceira' => $posicao->getInstituicaoFinanceira(),
                'dataReferencia' => $posicao->getDataReferencia(),
                'valorMercado' => $posicao->getValorMercado(),
                'ativo' => $posicao->getAtivo(),
                ]
            );

        if (!$entity) {
            return false;
        }

        return true;
    }

    protected function populatePosicaoTesouroDireto(
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
        $posicao->setValorBrutoTotal((float) $row['origem']);
        $posicao->setValorMercado((float) $row['origem']);
        //liquido
        $row['liquido'] = str_replace(',', '.', $row['liquido']);
        $posicao->setValorLiquidoTotal((float) $row['liquido']);

        return $posicao;
    }

    protected function populatePosicaoBmfBovespa(
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

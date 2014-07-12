<?php

namespace Royopa\SicinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Posicao
 *
 * @ORM\Table(name="POSICAO")
 * @ORM\Entity(repositoryClass="Royopa\SicinBundle\Repository\PosicaoRepository")
 */
class Posicao
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dt_referencia", type="date")
     */
    private $dataReferencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantidade", type="float")
     */
    private $quantidade;

    /**
     * @var float
     *
     * @ORM\Column(name="vr_mercado", type="float", nullable=true)
     */
    private $valorMercado;

    /**
     * @var float
     *
     */
    private $valorBrutoMes;

    /**
     * @var float
     *
     */
    private $valorLiquidoMes;

    /**
     * @var float
     *
     */
    private $valorAplicadoMes;

    /**
     * @var float
     *
     * @ORM\Column(name="vr_bruto_total", type="float")
     */
    private $valorBrutoTotal;

    /**
     * @var float
     *
     * @ORM\Column(name="vr_liquido_total", type="float")
     */
    private $valorLiquidoTotal;

    /**
     * @var float
     *
     */
    private $valorRendimentoMes;

    /**
     * @var float
     *
     */
    private $valorRendimentoTotal;

    /**
     * @var float
     *
     */
    private $percentualRendimentoTotal;

    /**
     * @var float
     *
     */
    private $percentualRendimentoMes;

    /**
     * @var float
     *
     */
    private $variacaoMesAnterior;

    /**
     * @var float
     *
     * @ORM\Column(name="vr_provento", type="float", nullable=true)
     */
    private $valorProvento;

    /**
     * @var \Royopa\SicinBundle\Entity\Posicao
     *
     */
    private $posicaoAnterior;

    /**
     * @var \Royopa\SicinBundle\Entity\Ativo
     *
     * @ORM\ManyToOne(targetEntity="Ativo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ativo_id", referencedColumnName="id")
     * })
     */
    private $ativo;

    /**
     * @var \Royopa\SicinBundle\Entity\InstituicaoFinanceira
     *
     * @ORM\ManyToOne(targetEntity="InstituicaoFinanceira")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="if_id", referencedColumnName="id")
     * })
     */
    private $instituicaoFinanceira;

    /**
     * Gets the value of id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the value of id.
     *
     * @param integer $id the id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets the value of dataReferencia.
     *
     * @return \DateTime
     */
    public function getDataReferencia()
    {
        return $this->dataReferencia;
    }

    /**
     * Sets the value of dataReferencia.
     *
     * @param \DateTime $dataReferencia the data referencia
     *
     * @return self
     */
    public function setDataReferencia(\DateTime $dataReferencia)
    {
        $this->dataReferencia = $dataReferencia;

        return $this;
    }

    /**
     * Gets the value of quantidade.
     *
     * @return float
     */
    public function getQuantidade()
    {
        return $this->quantidade;
    }

    /**
     * Sets the value of quantidade.
     *
     * @param float $quantidade the quantidade
     *
     * @return self
     */
    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;

        return $this;
    }

    /**
     * Gets the value of valorMercado.
     *
     * @return float
     */
    public function getValorMercado()
    {
        return $this->valorMercado;
    }

    /**
     * Sets the value of valorMercado.
     *
     * @param float $valorMercado the valor mercado
     *
     * @return self
     */
    public function setValorMercado($valorMercado)
    {
        $this->valorMercado = $valorMercado;

        return $this;
    }

    /**
     * Gets the value of valorBrutoMes.
     *
     * @return float
     */
    public function getValorBrutoMes()
    {
        return $this->valorBrutoMes;
    }

    /**
     * Sets the value of valorBrutoMes.
     *
     * @param float $valorBrutoMes the valor bruto mes
     *
     * @return self
     */
    public function setValorBrutoMes($valorBrutoMes)
    {
        $this->valorBrutoMes = $valorBrutoMes;

        return $this;
    }

    /**
     * Gets the value of valorLiquidoMes.
     *
     * @return float
     */
    public function getValorLiquidoMes()
    {
        return $this->valorLiquidoMes;
    }

    /**
     * Sets the value of valorLiquidoMes.
     *
     * @param float $valorLiquidoMes the valor liquido mes
     *
     * @return self
     */
    public function setValorLiquidoMes($valorLiquidoMes)
    {
        $this->valorLiquidoMes = $valorLiquidoMes;

        return $this;
    }

    /**
     * Gets the value of valorBrutoTotal.
     *
     * @return float
     */
    public function getValorBrutoTotal()
    {
        return $this->valorBrutoTotal;
    }

    /**
     * Sets the value of valorBrutoTotal.
     *
     * @param float $valorBrutoTotal the valor bruto total
     *
     * @return self
     */
    public function setValorBrutoTotal($valorBrutoTotal)
    {
        $this->valorBrutoTotal = $valorBrutoTotal;

        return $this;
    }

    /**
     * Gets the value of valorLiquidoTotal.
     *
     * @return float
     */
    public function getValorLiquidoTotal()
    {
        return $this->valorLiquidoTotal;
    }

    /**
     * Sets the value of valorLiquidoTotal.
     *
     * @param float $valorLiquidoTotal the valor liquido total
     *
     * @return self
     */
    public function setValorLiquidoTotal($valorLiquidoTotal)
    {
        $this->valorLiquidoTotal = $valorLiquidoTotal;

        return $this;
    }

    /**
     * Gets the value of valorRendimentoMes.
     *
     * @return float
     */
    public function getValorRendimentoMes()
    {
        return $this->valorRendimentoMes;
    }

    /**
     * Sets the value of valorRendimentoMes.
     *
     * @param float $valorRendimentoMes the valor rendimento mes
     *
     * @return self
     */
    public function setValorRendimentoMes($valorRendimentoMes)
    {
        $this->valorRendimentoMes = $valorRendimentoMes;

        return $this;
    }

    /**
     * Gets the value of valorRendimentoTotal.
     *
     * @return float
     */
    public function getValorRendimentoTotal()
    {
        return $this->valorRendimentoTotal;
    }

    /**
     * Sets the value of valorRendimentoTotal.
     *
     * @param float $valorRendimentoTotal the valor rendimento total
     *
     * @return self
     */
    public function setValorRendimentoTotal($valorRendimentoTotal)
    {
        $this->valorRendimentoTotal = $valorRendimentoTotal;

        return $this;
    }

    /**
     * Gets the value of percentualRendimentoTotal.
     *
     * @return float
     */
    public function getPercentualRendimentoTotal()
    {
        return $this->percentualRendimentoTotal;
    }

    /**
     * Sets the value of percentualRendimentoTotal.
     *
     * @param float $percentualRendimentoTotal the percentual rendimento total
     *
     * @return self
     */
    public function setPercentualRendimentoTotal($percentualRendimentoTotal)
    {
        $this->percentualRendimentoTotal = $percentualRendimentoTotal;

        return $this;
    }

    /**
     * Gets the value of percentualRendimentoMes.
     *
     * @return float
     */
    public function getPercentualRendimentoMes()
    {
        return $this->percentualRendimentoMes;
    }

    /**
     * Sets the value of percentualRendimentoMes.
     *
     * @param float $percentualRendimentoMes the percentual rendimento mes
     *
     * @return self
     */
    public function setPercentualRendimentoMes($percentualRendimentoMes)
    {
        $this->percentualRendimentoMes = $percentualRendimentoMes;

        return $this;
    }

    /**
     * Gets the value of variacaoMesAnterior.
     *
     * @return float
     */
    public function getVariacaoMesAnterior()
    {
        return $this->variacaoMesAnterior;
    }

    /**
     * Sets the value of variacaoMesAnterior.
     *
     * @param float $variacaoMesAnterior the variacao mes anterior
     *
     * @return self
     */
    public function setVariacaoMesAnterior($variacaoMesAnterior)
    {
        $this->variacaoMesAnterior = $variacaoMesAnterior;

        return $this;
    }

    /**
     * Gets the value of valorProvento.
     *
     * @return float
     */
    public function getValorProvento()
    {
        return $this->valorProvento;
    }

    /**
     * Sets the value of valorProvento.
     *
     * @param float $valorProvento the valor provento
     *
     * @return self
     */
    public function setValorProvento($valorProvento)
    {
        $this->valorProvento = $valorProvento;

        return $this;
    }

    /**
     * Gets the value of ativo.
     *
     * @return \Royopa\SicinBundle\Entity\Ativo
     */
    public function getAtivo()
    {
        return $this->ativo;
    }

    /**
     * Sets the value of ativo.
     *
     * @param \Royopa\SicinBundle\Entity\Ativo $ativo the ativo
     *
     * @return self
     */
    public function setAtivo(\Royopa\SicinBundle\Entity\Ativo $ativo)
    {
        $this->ativo = $ativo;

        return $this;
    }

    /**
     * Gets the value of instituicaoFinanceira.
     *
     * @return \Royopa\SicinBundle\Entity\InstituicaoFinanceira
     */
    public function getInstituicaoFinanceira()
    {
        return $this->instituicaoFinanceira;
    }

    /**
     * Sets the value of instituicaoFinanceira.
     *
     * @param \Royopa\SicinBundle\Entity\InstituicaoFinanceira $instituicaoFinanceira the instituicao financeira
     *
     * @return self
     */
    public function setInstituicaoFinanceira(\Royopa\SicinBundle\Entity\InstituicaoFinanceira $instituicaoFinanceira)
    {
        $this->instituicaoFinanceira = $instituicaoFinanceira;

        return $this;
    }

    /**
     * Gets the value of posicaoAnterior.
     *
     * @return \Royopa\SicinBundle\Entity\Posicao
     */
    public function getPosicaoAnterior()
    {
        return $this->posicaoAnterior;
    }

    /**
     * Sets the value of posicaoAnterior.
     *
     * @param \Royopa\SicinBundle\Entity\Posicao $posicaoAnterior the posicao anterior
     *
     * @return self
     */
    public function setPosicaoAnterior(\Royopa\SicinBundle\Entity\Posicao $posicaoAnterior)
    {
        $this->posicaoAnterior = $posicaoAnterior;

        //faz todos os cálculos em relação ao mês anterior
        //$this->posicaoAnterior->valorBrutoTotal;
        $this->valorAplicadoMes = $this->valorBrutoTotal - $this->posicaoAnterior->valorBrutoTotal;

        $this->valorRendimentoMes =
            $this->valorLiquidoTotal -
            $this->posicaoAnterior->valorLiquidoTotal -
            $this->valorAplicadoMes +
            $this->valorProvento;

        return $this;
    }

    /**
     * Gets the value of valorAplicadoMes.
     *
     * @return float
     */
    public function getValorAplicadoMes()
    {
        return $this->valorAplicadoMes;
    }

    /**
     * Sets the value of valorAplicadoMes.
     *
     * @param float $valorAplicadoMes the valor aplicado mes
     *
     * @return self
     */
    public function setValorAplicadoMes($valorAplicadoMes)
    {
        $this->valorAplicadoMes = $valorAplicadoMes;

        return $this;
    }
}

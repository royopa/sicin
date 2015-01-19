<?php

namespace Royopa\SicinBundle\Entity;

/**
 * Posicao Sintética
 *
 */
class PosicaoSintetica
{
    /**
     * @var \DateTime
     *
     */
    private $dataReferencia;

    /**
     * @var string
     *
     */
    private $nome;

    /**
     * @var float
     *
     */
    private $valorBrutoTotal;

    /**
     * @var float
     *
     */
    private $valorLiquidoTotal;

    /**
     * @var float
     *
     */
    private $valorProvento;

    /**
     * @var float
     *
     */
    private $valorMercado;

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
     * Gets the value of nome.
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Sets the value of nome.
     *
     * @param string $nome the nome
     *
     * @return self
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

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
}

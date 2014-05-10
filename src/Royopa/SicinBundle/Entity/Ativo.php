<?php

namespace Royopa\SicinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ativo
 *
 * @ORM\Table(name="ATIVO")
 * @ORM\Entity
 */
class Ativo
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
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=255)
     */
    private $codigo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_vencimento", type="date", nullable=true)
     */
    private $dataVencimento;

    /**
     * @var \Royopa\SicinBundle\Entity\AtivoTipo
     *
     * @ORM\ManyToOne(targetEntity="AtivoTipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipo_id", referencedColumnName="id")
     * })
     */
    private $tipo;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nome
     *
     * @param  string $nome
     * @return Ativo
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set dataVencimento
     *
     * @param  \DateTime $dataVencimento
     * @return Ativo
     */
    public function setDataVencimento($dataVencimento)
    {
        $this->dataVencimento = $dataVencimento;

        return $this;
    }

    /**
     * Get dataVencimento
     *
     * @return \DateTime
     */
    public function getDataVencimento()
    {
        return $this->dataVencimento;
    }

    /**
     * Set tipo
     *
     * @param  \stdClass $tipo
     * @return Ativo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return \stdClass
     */
    public function getTipo()
    {
        return $this->tipo;
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
     * Gets the value of codigo.
     *
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Sets the value of codigo.
     *
     * @param string $codigo the codigo
     *
     * @return self
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * __toString()
     *
     * @return string
     */
    public function __toString()
    {
        return $this->codigo . ' - ' . $this->nome;
    }
}

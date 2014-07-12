<?php

namespace Royopa\SicinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AtivoTipo
 *
 * @ORM\Table(name="ATIVO_TIPO")
 * @ORM\Entity
 */
class AtivoTipo
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
     * @var \Royopa\SicinBundle\Entity\AtivoCategoria
     *
     * @ORM\ManyToOne(targetEntity="AtivoCategoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categoria_id", referencedColumnName="id")
     * })
     */
    private $categoria;

    /**
     * @var \Royopa\SicinBundle\Entity\TaxaTipo
     *
     * @ORM\ManyToOne(targetEntity="TaxaTipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="taxa_tipo_id", referencedColumnName="id")
     * })
     */
    private $taxa;

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
     * @param  string    $nome
     * @return AtivoTipo
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
     * Set categoria
     *
     * @param  \stdClass $categoria
     * @return AtivoTipo
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return \stdClass
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * __toString()
     *
     * @return string
     */
    public function __toString()
    {
        return $this->nome;
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
     * Gets the }).
     *
     * @return \Royopa\SicinBundle\Entity\TaxaTipo
     */
    public function getTaxa()
    {
        return $this->taxa;
    }

    /**
     * Sets the }).
     *
     * @param \Royopa\SicinBundle\Entity\TaxaTipo $taxa the taxa
     *
     * @return self
     */
    public function setTaxa(\Royopa\SicinBundle\Entity\TaxaTipo $taxa)
    {
        $this->taxa = $taxa;

        return $this;
    }
}

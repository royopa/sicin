<?php

namespace Royopa\SicinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Taxa Tipo - Tipo de taxa de juros (pré/pós/mista)
 *
 * @ORM\Table(name="TAXA_TIPO")
 * @ORM\Entity
 */
class TaxaTipo
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
     * __toString()
     *
     * @return string
     */
    public function __toString()
    {
        return $this->nome;
    }
}

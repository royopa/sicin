<?php

namespace Royopa\SicinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AtivoCategoria
 *
 * @ORM\Table(name="ATIVO_CATEGORIA")
 * @ORM\Entity
 */
class AtivoCategoria
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
     * @ORM\Column(name="nome", type="string", length=200)
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
     * @param  string         $nome
     * @return AtivoCategoria
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

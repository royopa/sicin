<?php

namespace Royopa\SicinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InstituicaoFinanceira
 *
 * @ORM\Table(name="IF")
 * @ORM\Entity
 */
class InstituicaoFinanceira
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
     * @var integer
     *
     * @ORM\Column(name="cnpj", type="integer")
     */
    private $cnpj;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=150)
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
     * Set cnpj
     *
     * @param  integer               $cnpj
     * @return InstituicaoFinanceira
     */
    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;

        return $this;
    }

    /**
     * Get cnpj
     *
     * @return integer
     */
    public function getCnpj()
    {
        return $this->cnpj;
    }

    /**
     * Set nome
     *
     * @param  string                $nome
     * @return InstituicaoFinanceira
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

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
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255, nullable=true)
     */
    private $link;

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

    private function mask($val, $mask)
    {
        $maskared = '';
        $k = 0;
        for ($i = 0; $i <= strlen($mask) - 1; $i++) {
            if ($mask[$i] == '#') {
                if (isset ($val[$k]))
                    $maskared .= $val[$k++];
            } else {
                if (isset ($mask[$i]))
                    $maskared .= $mask[$i];
            }
        }

        return $maskared;
    }

    /**
     * Get cnpj
     *
     * @return integer
     */
    public function getCnpjFormatado()
    {
        $cnpj = (string) $this->cnpj;

        $cnpj = str_pad($cnpj, 14, '0', STR_PAD_LEFT);

        return $this->mask($cnpj,'##.###.###/####-##');
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
     * Gets the value of link.
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Sets the value of link.
     *
     * @param string $link the link
     *
     * @return self
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }
}

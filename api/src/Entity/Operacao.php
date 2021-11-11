<?php

namespace App\Entity;

use App\Entity\Shared\AbstractEntity;
use App\Repository\OperacaoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OperacaoRepository::class)
 */
class Operacao extends AbstractEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\ManyToOne(targetEntity="Carteira")
     * @ORM\JoinColumn(nullable=false)
     */
    public $carteira;

    /**
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="TipoOperacao")
     * @ORM\JoinColumn(nullable=false)
     */
    public $tipoOperacao;

    /**
     * @ORM\Column(type="float")
     */
    public $valor;

    /**
     * @var \DateTime
     * @ORM\Column(name="create_at", type="datetime")
     */
    protected $dataCadastro;

    public function __construct()
    {
        $this->dataCadastro = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCarteira(): ?Carteira
    {
        return $this->carteira;
    }

    public function setCarteira(Carteira $carteira): self
    {
        $this->carteira = $carteira;

        return $this;
    }

    public function getTipoOperacao()
    {
        return $this->tipoOperacao;
    }

    public function setTipoOperacao(int $tipoOperacao): self
    {
        $this->tipoOperacao = $tipoOperacao;

        return $this;
    }

    public function getValor(): ?float
    {
        return $this->valor;
    }

    public function setValor(float $valor): self
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getDataCadastro()
    {
        return $this->dataCadastro;
    }

    /**
     * @param \DateTime $dataCadastro
     */
    public function setDataCadastro($dataCadastro)
    {
        $this->dataCadastro = $dataCadastro;
    }
}

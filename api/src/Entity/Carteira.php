<?php

namespace App\Entity;

use App\Entity\Shared\AbstractEntity;
use App\Repository\CarteiraRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Exception\ValidatorException;

/**
 * @ORM\Entity(repositoryClass=CarteiraRepository::class)
 */
class Carteira extends AbstractEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\Column(type="float")
     */
    public $saldo;

    /**
     * @ORM\OneToOne(targetEntity="Usuario", inversedBy="carteira", fetch="LAZY")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     */
    protected $usuario;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSaldo(): ?float
    {
        return $this->saldo;
    }

    public function setSaldo(float $saldo): self
    {
        $this->saldo = $saldo;
        if ($this->saldo < 0) {
            throw new ValidatorException('Você não possui saldo para esta operação');
        }

        return $this;
    }

    public function addSaldo(float $saldo): self
    {
        $this->saldo += $saldo;
        if ($this->saldo < 0) {
            throw new ValidatorException('Você não possui saldo para esta operação');
        }

        return $this;
    }

    public function subSaldo(float $saldo): self
    {
        $this->saldo -= $saldo;
        if ($this->saldo < 0) {
            throw new ValidatorException('Você não possui saldo para esta operação');
        }

        return $this;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(Usuario $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }
}

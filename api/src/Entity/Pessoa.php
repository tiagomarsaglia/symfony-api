<?php

namespace App\Entity;

use App\Entity\Shared\AbstractEntity;
use App\Repository\PessoaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PessoaRepository::class)
 */
class Pessoa extends AbstractEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $nome;

    /**
     * @ORM\OneToOne(targetEntity="PessoaFisica", mappedBy="pessoa")
     */
    public $pessoaFisica;

    /**
     * @ORM\OneToOne(targetEntity="PessoaJuridica", mappedBy="pessoa")
     */
    public $pessoaJuridica;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getPessoaFisica(): ?PessoaFisica
    {
        return $this->pessoaFisica;
    }

    public function setPessoaFisica(PessoaFisica $pessoaFisica): self
    {
        $this->pessoaFisica = $pessoaFisica;

        return $this;
    }

    public function getPessoaJuridica(): ?PessoaJuridica
    {
        return $this->pessoaJuridica;
    }

    public function setPessoaJuridica(PessoaJuridica $pessoaJuridica): self
    {
        $this->pessoaJuridica = $pessoaJuridica;

        return $this;
    }
}

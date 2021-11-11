<?php

namespace App\Entity;

use App\Entity\Shared\AbstractEntity;
use App\Repository\PessoaFisicaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="pessoa_fisica", uniqueConstraints={
 *  @ORM\UniqueConstraint(name="TB_PESSOA_FISICA_CPF_UQ", columns={"cpf"})
 * })
 * @ORM\Entity(repositoryClass=PessoaFisicaRepository::class)
 */
class PessoaFisica extends AbstractEntity
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
    public $cpf;

    /**
     * @ORM\OneToOne(targetEntity="Pessoa", inversedBy="pessoaFisica")
     * @ORM\JoinColumn(name="pessoa_id", referencedColumnName="id")
     */
    protected $pessoa;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCpf(): ?string
    {
        return $this->cpf;
    }

    public function setCpf(string $cpf): self
    {
        $this->cpf = $cpf;

        return $this;
    }

    public function getPessoa(): ?Pessoa
    {
        return $this->pessoa;
    }

    public function setPessoa(Pessoa $pessoa): self
    {
        $this->pessoa = $pessoa;

        return $this;
    }
}

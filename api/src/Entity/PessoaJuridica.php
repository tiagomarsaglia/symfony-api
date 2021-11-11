<?php

namespace App\Entity;

use App\Entity\Shared\AbstractEntity;
use App\Repository\PessoaJuridicaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="pessoa_juridica", uniqueConstraints={
 *  @ORM\UniqueConstraint(name="TB_PESSOA_JURIDICA_CNPJ_UQ", columns={"cnpj"})
 * })
 * @ORM\Entity(repositoryClass=PessoaJuridicaRepository::class)
 */
class PessoaJuridica extends AbstractEntity
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
    public $cnpj;

    /**
     * @ORM\OneToOne(targetEntity="Pessoa", inversedBy="pessoaJuridica")
     * @ORM\JoinColumn(name="pessoa_id", referencedColumnName="id")
     */
    protected $pessoa;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCnpj(): ?string
    {
        return $this->cnpj;
    }

    public function setCnpj(string $cnpj): self
    {
        $this->cnpj = $cnpj;

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

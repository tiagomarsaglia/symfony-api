<?php

namespace App\Entity;

use App\Entity\Shared\AbstractEntity;
use App\Repository\UsuarioRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="usuario", uniqueConstraints={
 *  @ORM\UniqueConstraint(name="TB_USUARIO_DS_EMAIL_UQ", columns={"email"})
 * })
 * @ORM\Entity(repositoryClass=UsuarioRepository::class)
 */
class Usuario extends AbstractEntity
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
    public $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $senha;

    /**
     * @ORM\ManyToOne(targetEntity="Pessoa", fetch="EAGER")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $pessoa;

    /**
     * @ORM\OneToOne(targetEntity="Carteira", mappedBy="usuario")
     */
    public $carteira;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCarteira(): ?Carteira
    {
        return $this->carteira;
    }

    public function setCarteira(Carteira $carteira): self
    {
        $this->carteira = $carteira;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getSenha(): ?string
    {
        return $this->senha;
    }

    public function setSenha(string $senha): self
    {
        $this->senha = $senha;

        return $this;
    }
}

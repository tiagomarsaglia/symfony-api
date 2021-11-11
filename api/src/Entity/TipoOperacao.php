<?php

namespace App\Entity;

use App\Entity\Shared\AbstractEntity;
use App\Repository\TipoOperacaoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TipoOperacaoRepository::class)
 */
class TipoOperacao extends AbstractEntity
{
    /**
     * ID TIPO DE OPERACAO.
     */
    public const SACAR = 1;
    public const RECEBER = 2;
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
}

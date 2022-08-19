<?php

namespace Erick\Sistema\Entity;

use JsonSerializable;

/**
 * @Entity
 * @Table(name="cursos")
 */
class Ordem implements JsonSerializable
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    private $id;
    /**
     * @Column(type="string")
     */
    private $descricao;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }
    public function jsonSerialize() : mixed
    {
        return [
            'id' => $this->id,
            'descricao' => $this->descricao
        ];
    }
}
<?php

namespace Erick\Sistema\Entity;

use JsonSerializable;

/**
 * @Entity
 * @Table(name="ordens")
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
    private $ordem;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getOrdem(): string
    {
        return $this->ordem;
    }

    public function setOrdem(string $ordem): void
    {
        $this->ordem = $ordem;
    }
    public function jsonSerialize() : mixed
    {
        return [
            'id' => $this->id,
            'ordem' => $this->ordem
        ];
    }
}

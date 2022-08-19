<?php

namespace Erick\Sistema\Entity;

use JsonSerializable;

/**
 * @Entity
 * @Table(name="setor")
 */
class Setor implements JsonSerializable
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
    private $setor;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getSetor(): string
    {
        return $this->setor;
    }

    public function setSetor(string $setor): void
    {
        $this->setor = $setor;
    }
    public function jsonSerialize() : mixed
    {
        return [
            'id' => $this->id,
            'setor' => $this->setor
        ];
    }
}

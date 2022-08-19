<?php

namespace Erick\Sistema\Entity;

/**
 * @Entity
 * @Table(name="usuarios")
 */
class Usuario
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
    private $email;
    /**
     * @Column(type="string")
     */
    private $senha;

    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
    public function setSenha(string $senha): void
    {
        $this->senha = $senha;
    }

    public function senhaEstaCorreta(string $senhaPura): bool
    {
        return password_verify($senhaPura, $this->senha);
    }
}

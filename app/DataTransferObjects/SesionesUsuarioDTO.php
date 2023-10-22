<?php

namespace App\DataTransferObjects;

class SesionesUsuarioDTO
{
    private int $id;
    private string $dateTimeSession;
    private string $lastEntry;
    private int $idusuario;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getDateTimeSession(): string
    {
        return $this->dateTimeSession;
    }

    public function setDateTimeSession(string $dateTimeSession): void
    {
        $this->dateTimeSession = $dateTimeSession;
    }

    public function getLastEntry(): string
    {
        return $this->lastEntry;
    }

    public function setLastEntry(string $lastEntry): void
    {
        $this->lastEntry = $lastEntry;
    }

    public function getIdusuario(): int
    {
        return $this->idusuario;
    }

    public function setIdusuario(int $idusuario): void
    {
        $this->idusuario = $idusuario;
    }
}

<?php

namespace App\DataTransferObjects;

class PublicationDTO
{
    private int $id;
    private string $content;
    private string $dateContent;
    private int $likeCounter;
    private int $id_usuario;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getDateContent(): string
    {
        return $this->dateContent;
    }

    public function setDateContent(string $dateContent): void
    {
        $this->dateContent = $dateContent;
    }

    public function getLikeCounter(): int
    {
        return $this->likeCounter;
    }

    public function setLikeCounter(int $likeCounter): void
    {
        $this->likeCounter = $likeCounter;
    }

    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    public function setIdUsuario(int $id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }
}

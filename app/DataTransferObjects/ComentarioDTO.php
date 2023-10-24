<?php

namespace App\DataTransferObjects;

class ComentarioDTO
{
    private int $id;
    private string $content;
    private \DateTime $creationDate;
    private int $idCommentReply;
    private int $idUser;
    private int $idPost;

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

    public function getCreationDate(): \DateTime
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTime $creationDate): void
    {
        $this->creationDate = $creationDate;
    }

    public function getIdCommentReply(): int
    {
        return $this->idCommentReply;
    }

    public function setIdCommentReply(int $idCommentReply): void
    {
        $this->idCommentReply = $idCommentReply;
    }

    public function getIdUser(): int
    {
        return $this->idUser;
    }

    public function setIdUser(int $idUser): void
    {
        $this->idUser = $idUser;
    }

    public function getIdPost(): int
    {
        return $this->idPost;
    }

    public function setIdPost(int $idPost): void
    {
        $this->idPost = $idPost;
    }
}
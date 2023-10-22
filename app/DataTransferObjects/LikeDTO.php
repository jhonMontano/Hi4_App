<?php

namespace App\DataTransferObjects;

class LikeDTO
{
    private int $id;
    private int $idUser;
    private int $idPublication;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUserId()
    {
        return $this->idUser;
    }

    public function setUserId($idUser)
    {
        $this->idUser = $idUser;
    }

    public function getPublicationId()
    {
        return $this->idPublication;
    }

    public function setPublicationId($idPublication)
    {
        $this->idPublication = $idPublication;
    }
}
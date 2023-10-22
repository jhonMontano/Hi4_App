<?php

namespace App\DataTransferObjects;

class FollowerDTO
{
    private int $id;
    private string $status;
    private int $idFollower;
    private int $idFollowedUser;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getIdFollower(): int
    {
        return $this->idFollower;
    }

    public function setIdFollower(int $idFollower): void
    {
        $this->idFollower = $idFollower;
    }

    public function getIdFollowedUser(): int
    {
        return $this->idFollowedUser;
    }

    public function setIdFollowedUser(int $idFollowedUser): void
    {
        $this->idFollowedUser = $idFollowedUser;
    }
}
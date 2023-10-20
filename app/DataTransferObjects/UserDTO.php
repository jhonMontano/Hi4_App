<?php

namespace App\DataTransferObjects;

class UserDTO
{
    private int $id;
    private string $name;
    private string $email;
    private string $bornDate;
    private string $lastName;
    private string $gender;
    private string $username;
    private string $password;
    private string $registerDate;

    public function __construct(){    
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getBornDate(): string
    {
        return $this->bornDate;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRegisterDate(): string
    {
        return $this->registerDate;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setBornDate(string $bornDate): void
    {
        $this->bornDate = $bornDate;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function setGender(string $gender): void
    {
        $this->gender = $gender;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function SetRegisterDate(string $registerDate)
    {
        $this->registerDate = $registerDate;
    }
}

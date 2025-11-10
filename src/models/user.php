<?php

namespace Dsw\Blog\Models;

use DateTime;

class User
{
    private int $id;
    private string $name;
    private string $email;
    private DateTime $createdAt;

    public function __construct(int $id, string $name, string $email, DateTime $createdAt)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->createdAt = $createdAt;
    }

    public function __toString()
    {
        return $this->id . " " . $this->name . " " . $this->email . " " . $this->createdAt->format('Y-m-d');
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

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

}
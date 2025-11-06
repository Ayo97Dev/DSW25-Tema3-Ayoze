<?php

namespace Dsw\Blog;

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
        return $this->name . " " . $this->email;
    }
}
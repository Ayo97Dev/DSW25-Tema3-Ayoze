<?php
namespace Dsw\Blog;

use PDO;
use DateTime;

class UserDao
{

    public function __construct(
        private PDO $conn,
    )
    {
    }

    public function get($id): ?User
    {
        $stmt = $this->conn->prepare("SELECT id, name, email, created_at FROM user WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch();

        if (!$data) {
            return null;
        }

        return new User(
            id: (int)$data['id'],
            name: $data['name'],
            email: $data['email'],
            createdAt: new DateTime($data['created_at'])
        );
    }
}
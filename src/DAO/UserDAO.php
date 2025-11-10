<?php
namespace Dsw\Blog\DAO;

use PDO;
use DateTime;
use Dsw\Blog\Models\User;

class UserDao
{

    public function __construct(
        private PDO $conn,
    ) {}

    public function get($id): ?User
    {
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE id = :id");
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

    public function getAll(): array
    {
        $users = [];
        $stmt = $this->conn->prepare("SELECT * FROM user");
        $stmt->execute();
        $data = $stmt->fetchAll();

        foreach ($data as $item) {
            $users[] = new User(
                id: (int)$item['id'],
                name: $item['name'],
                email: $item['email'],
                createdAt: new DateTime($item['created_at'])
            );
        }

        return $users;
    }

    public function delete($id): void {
        $stmt = $this->conn->prepare("DELETE FROM user WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }

    public function update(User $user): void {
        $stmt = $this->conn->prepare("UPDATE user SET name = :name, email = :email WHERE id = :id");
        $stmt->execute([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'id' => $user->getId()
        ]);
    }

    public function create(User $user): User {
        $stmt = $this->conn->prepare("INSERT INTO user (name, email) VALUES (:name, :email)");
        $stmt->execute([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
        ]);
        $user->setId($this->conn->lastInsertId());
        
        return $user;
    }

}
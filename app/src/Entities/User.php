<?php

namespace App\Entities;

use App\Entities\AbstractEntity;
use App\Database\DbConnexion;
use App\Http\Request;

class User extends AbstractEntity
{
    private int $userId;
    private string $userName;
    private string $userEmail;
    private string $userPassword;

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function setUserName($name)
    {
        $this->userName = $this->removeSpecialChar($name);
    }

    public function getUserEmail(): string
    {
        return $this->userEmail;
    }

    public function setUserEmail($email)
    {
        $this->userEmail = $email;
    }

    public function getUserPassword(): string
    {
        return $this->userPassword;
    }

    public function setUserPassword($password)
    {
        $this->userPassword = password_hash($password, PASSWORD_BCRYPT);
    }

    public function create(): bool
    {
        $db = (new DbConnexion())->execute();

        $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $stmt = $db->prepare($sql);
        return $stmt->execute([
            'name' => $this->userName,
            'email' => $this->userEmail,
            'password' => $this->userPassword
        ]);
    }

    public function check(string $email, string $password): bool
    {
        $db = (new DbConnexion())->execute();

        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $db->prepare($sql);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return true;
        }

        return false;
    }

    public function update(int $id, array $data): bool
    {
        $db = (new DbConnexion())->execute();

        $fields = [];
        $params = ['id' => $id];

        if (isset($data['name'])) {
            $fields[] = 'name = :name';
            $params['name'] = $this->removeSpecialChar($data['name']);
        }

        if (isset($data['email'])) {
            $fields[] = 'email = :email';
            $params['email'] = $data['email'];
        }

        if (isset($data['password'])) {
            $fields[] = 'password = :password';
            $params['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        }

        if (empty($fields)) {
            return false;
        }

        $sql = 'UPDATE users SET ' . implode(', ', $fields) . ' WHERE id = :id';
        $stmt = $db->prepare($sql);
        return $stmt->execute($params);
    }

    public function getAllUsers(): array
    {
        $db = (new DbConnexion())->execute();

        $sql = "SELECT * FROM users";
        $stmt = $db->query($sql);
        $users = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $users;
    }

    public function delete(int $id): bool
    {
        $db = (new DbConnexion())->execute();

        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}

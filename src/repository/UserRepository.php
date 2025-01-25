<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository {

    public function getUser(string $email): ?User {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM users WHERE email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return null;
        }

        return new User(
            $user['id'],
            $user['email'],
            $user['password'],
            $user['name'],
            $user['surname'],
            $user['age']
        );
    }

    public function addUser(User $user): bool {
        $stmt = $this->database->connect()->prepare('
        SELECT COUNT(*) FROM users WHERE email = :email
        ');
        $stmt->bindParam(':email', $user->getEmail(), PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->fetchColumn() > 0) {
            return false;
        }

        $stmt = $this->database->connect()->prepare('
            INSERT INTO users (email, password, name, surname, age)
            VALUES (:email, :password, :name, :surname, :age)
        ');

        return $stmt->execute([
            ':email' => $user->getEmail(),
            ':password' => password_hash($user->getPassword(), PASSWORD_BCRYPT),
            ':name' => $user->getName(),
            ':surname' => $user->getSurname(),
            ':age' => $user->getAge()
        ]);
    }
}
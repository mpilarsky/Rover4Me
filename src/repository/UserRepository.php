<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository {

    public function getUser(string $email): ?User {
        $stmt = $this->database->connect()->prepare('
            SELECT users.*, permissions.*  FROM users  JOIN permissions ON users.id = permissions.user_id  WHERE users.email = :email
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
            $user['age'],
            $user['isadmin'],
            $user['ismod']
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
            RETURNING id
        ');

        $result = $stmt->execute([
            ':email' => $user->getEmail(),
            ':password' => password_hash($user->getPassword(), PASSWORD_BCRYPT),
            ':name' => $user->getName(),
            ':surname' => $user->getSurname(),
            ':age' => $user->getAge()
        ]);

        if ($result) {
            $userId = $stmt->fetchColumn();
    
            $stmt = $this->database->connect()->prepare('
                INSERT INTO permissions (user_id, isadmin, ismod)
                VALUES (:user_id, 0, 0)
            ');
    
            $stmt->execute([':user_id' => $userId]);
        }
    
        return $result;
    }
}
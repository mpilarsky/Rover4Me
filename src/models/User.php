<?php

class User{
    private $id;
    private $email;
    private $password;
    private $name;
    private $surname;
    private $age;
    private $isMod;
    private $isAdmin;

    public function __construct(
        $id, $email, $password, $name, $surname, $age, $isAdmin = 0, $isMod = 0
    ) {
        $this->id= $id;
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->surname = $surname;
        $this->age = $age;
        $this->isMod = $isMod;
        $this->isAdmin = $isAdmin;

    }
    public function getId() {
        return $this->id;
    }
    public function getEmail(): string 
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }
    public function getName() {
        return $this->name;
    }

    public function getSurname() {
        return $this->surname;
    }

    public function getAge() {
        return $this->age;
    }
    public function getisMod() {
        return $this->isMod;
    }
    public function getisAdmin() {
        return $this->isAdmin;
    }
}
<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/User.php';
require_once __DIR__ . '/../repository/UserRepository.php';

class SecurityController extends AppController {

    private $userRepository;

    public function __construct() {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function login()
    {   
        session_start();

        $messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : [];
        unset($_SESSION['messages']);

        if (!$this->isPost()) {
            return $this->render('login', ['messages' => $messages]);
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
        $user = $this->userRepository->getUser($email);

        if (!$user) {
            return $this->render('login', ['messages' => ['Nie ma takiego użytkownika!']]);
        }

        if (!password_verify($password, $user->getPassword())) {
            return $this->render('login', ['messages' => ['Żłe hasło!']]);
        }

        $_SESSION['user_id'] = $user->getId();
        $_SESSION['isAdmin'] = $user->getisAdmin();
        $_SESSION['isMod'] = $user->getisMod();

        var_dump($user->getisAdmin());
        var_dump($user->getisMod());

        if($user->getisAdmin()) {
            echo "<script>window.location.href = '/adminDashboard';</script>";
        } elseif($user->getisMod()) {
            echo "<script>window.location.href = '/modDashboard';</script>";
        } else {
            echo "<script>window.location.href = '/userDashboard';</script>";
        }
        exit();

    }

    public function signup() {
        
        if (!$this->isPost()) {
            return $this->render('signup');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
        $age = $_POST['age'];
        $name = $_POST['first-name'];
        $surname = $_POST['last-name'];

        $user = new User(null, $email, $password, $name, $surname, $age);

        if ($this->userRepository->addUser($user)) {
            $_SESSION['messages'] = ['Rezerwacja przebiegła pomyślnie!'];
            echo "<script>alert('Rezerwacja przebiegła pomyślnie!'); window.location.href = '/login';</script>";
            exit();
        } else {
            return $this->render('signup', ['messages' => ['Rejestracja nieudana jest już użytkownik o takim adresie!']]);
        }
    }

    public function logout() {
        if ($this->isPost()) {
            session_start();
            session_unset();
            session_destroy();
            echo "<script>window.location.href = '/dashboard';</script>";
            exit();
        }
    }
    
    
}
<?php

require_once 'AppController.php';

class DefaultController extends AppController{
    public function index(){
        $this->render('dashboard');
    }

    public function dashboard(){
        $this->render('dashboard');
    }

    public function reservation(){
        $this->render('addReservation');
    }
    public function signup() {
        $this->render('signup');
    }
    public function userDashboard(){
        session_start();
        if (!isset($_SESSION['user_id'])) {
            echo "<script>window.location.href = '/login';</script>";
            exit();
        }
    
        $this->render('userDashboard');
    }

}
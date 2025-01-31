<?php


require 'Routing.php';


$path=trim($_SERVER['REQUEST_URI'], '/');
$path=parse_url($path, PHP_URL_PATH);


Routing::get('', 'DefaultController');
Routing::get('dashboard', 'DefaultController');
Routing::get('userDashboard', 'DefaultController');

Routing::get('modDashboard', 'DefaultController');
Routing::get('adminDashboard', 'DefaultController');

Routing::get('login', 'DefaultController');
Routing::get('signup', 'DefaultController');
Routing::get('login', 'SecurityController');
Routing::get('signup', 'SecurityController');
Routing::get('logout', 'SecurityController');
Routing::get('reservation', 'DefaultController');


Routing::post('login', 'SecurityController');
Routing::post('addReservation', 'ReservationController');
Routing::post('signup', 'SecurityController');
Routing::post('logout', 'SecurityController');


Routing::run($path);
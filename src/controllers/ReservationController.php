<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/Reservation.php';
require_once __DIR__ . '/../repository/ReservationRepository.php';

class ReservationController extends AppController
{
    private $reservationRepository;

    public function __construct()
    {
        parent::__construct();
        $this->reservationRepository = new ReservationRepository();
    }

    public function addReservation()
    {
        session_start();

        if (!isset($_SESSION['user_id'])) {
            echo "<script>alert('Musisz być zalogowany, aby dodać rezerwację!'); window.location.href = '/login';</script>";
            exit();
        }

        if (!$this->isPost()) {
            return $this->render('addReservation');
        }

        $name = $_POST['name'];
        $location = $_POST['location'];
        $frameSize = $_POST['frame_size'];
        $theme = $_POST['theme'];
        $date = $_POST['date'];
        $startTime = $_POST['start_time'];
        $endTime = $_POST['end_time'];
        $bikeType = $_POST['bike_type'];
        $userId = $_SESSION['user_id'];

        $reservation = new Reservation(
            null,
            $name,
            $location,
            $frameSize,
            $theme,
            $date,
            $startTime,
            $endTime,
            $bikeType,
            $userId
        );

        if ($this->reservationRepository->addReservation($reservation)) {
            echo "<script>alert('Rezerwacja została pomyślnie dodana!'); window.location.href = '/userDashboard';</script>";
        } else {
            echo "<script>alert('Wystąpił błąd podczas dodawania rezerwacji. Spróbuj ponownie.'); window.location.href = '/addReservation';</script>"; //window.location.href = '/addReservation';
        }
    }
}

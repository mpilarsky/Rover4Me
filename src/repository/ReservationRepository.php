<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Reservation.php';

class ReservationRepository extends Repository
{
    public function addReservation(Reservation $reservation): bool
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO reservations (name, location, frame_size, theme, reservation_date, start_time, end_time, bike_type, user_id)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ');
        try {
            $stmt->execute([
                $reservation->getName(),
                $reservation->getLocation(),
                $reservation->getFrameSize(),
                $reservation->getTheme(),
                $reservation->getDate(),
                $reservation->getStartTime(),
                $reservation->getEndTime(),
                $reservation->getBikeType(),
                $reservation->getUserId()
            ]);

            return true;
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return false;
        }
    }
}

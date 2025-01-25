<?php

class Reservation
{
    private ?int $id;
    private string $name;
    private string $location;
    private string $frameSize;
    private string $theme;
    private string $date;
    private string $startTime;
    private string $endTime;
    private string $bikeType;
    private int $userId;

    public function __construct(
        ?int $id,
        string $name,
        string $location,
        string $frameSize,
        string $theme,
        string $date,
        string $startTime,
        string $endTime,
        string $bikeType,
        int $userId
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->location = $location;
        $this->frameSize = $frameSize;
        $this->theme = $theme;
        $this->date = $date;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->bikeType = $bikeType;
        $this->userId = $userId;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function getFrameSize(): string
    {
        return $this->frameSize;
    }

    public function getTheme(): string
    {
        return $this->theme;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getStartTime(): string
    {
        return $this->startTime;
    }

    public function getEndTime(): string
    {
        return $this->endTime;
    }

    public function getBikeType(): string
    {
        return $this->bikeType;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
}

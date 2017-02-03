<?php


namespace Madkom\Appointment;

/**
 * Class AppointmentTimeFrame
 * @package Madkom\Appointment
 * @author Dariusz Gafka <d.gafka@madkom.pl>
 */
class AppointmentTimeFrame
{
    /**
     * @var \DateTimeImmutable
     */
    private $startAt;
    /**
     * @var \DateTimeImmutable
     */
    private $endAt;

    /**
     * AppointmentTimeFrame constructor.
     * @param \DateTimeImmutable $startAt
     * @param \DateTimeImmutable $endAt
     */
    private function __construct(\DateTimeImmutable $startAt, \DateTimeImmutable $endAt)
    {
//        Here some validation e.g. if start is before end
        $this->startAt = $startAt;
        $this->endAt = $endAt;
    }

    /**
     * @param \DateTimeImmutable $startAt
     * @param \DateTimeImmutable $endAt
     * @return AppointmentTimeFrame
     */
    public static function create(\DateTimeImmutable $startAt, \DateTimeImmutable $endAt) : self
    {
        return new self($startAt, $endAt);
    }

    /**
     * @return \DateTimeImmutable
     */
    public function startAt() : \DateTimeImmutable
    {
        return $this->startAt;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function endAt() : \DateTimeImmutable
    {
        return $this->endAt;
    }
}
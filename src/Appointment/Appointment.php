<?php

namespace Madkom\Appointment;

use Ramsey\Uuid\Uuid;

/**
 * Class Appointment
 * @package Madkom\Appointment
 * @author Dariusz Gafka <d.gafka@madkom.pl>
 */
class Appointment
{
    /**
     * @var Uuid
     */
    private $appointmentId;
    /**
     * @var Uuid
     */
    private $organizerId;
    /**
     * @var Uuid
     */
    private $invitedPersonId;
    /**
     * @var Uuid
     */
    private $agreementId;
    /**
     * @var AppointmentTimeFrame
     */
    private $appointmentTimeFrame;

    /**
     * Appointment constructor.
     * @param Uuid $appointmentId
     * @param Uuid $organizerId
     * @param Uuid $invitedPersonId
     * @param Uuid $agreementId
     * @param AppointmentTimeFrame $appointmentTimeFrame
     */
    public function __construct(Uuid $appointmentId, Uuid $organizerId, Uuid $invitedPersonId, Uuid $agreementId, AppointmentTimeFrame $appointmentTimeFrame)
    {
        $this->appointmentId = $appointmentId;
        $this->organizerId = $organizerId;
        $this->invitedPersonId = $invitedPersonId;
        $this->agreementId = $agreementId;
        $this->appointmentTimeFrame = $appointmentTimeFrame;
    }

    /**
     * @return Uuid
     */
    public function appointmentId() : Uuid
    {
        return $this->appointmentId;
    }

    /**
     * @return Uuid
     */
    public function organizerId() : Uuid
    {
        return $this->organizerId;
    }

    /**
     * @return Uuid
     */
    public function invitedPersonId() : Uuid
    {
        return $this->invitedPersonId;
    }

    /**
     * @return Uuid
     */
    public function agreementId() : Uuid
    {
        return $this->agreementId;
    }

    /**
     * @return AppointmentTimeFrame
     */
    public function appointmentTimeFrame() : AppointmentTimeFrame
    {
        return $this->appointmentTimeFrame;
    }
}
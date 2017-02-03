<?php

namespace Madkom\Appointment;

use Madkom\Agreement\AgreementRepository;
use Madkom\Clock;
use Madkom\Specification;
use Madkom\UuidGenerator;

/**
 * Class AppointmentFactory
 * @package Madkom\Appointment
 * @author Dariusz Gafka <d.gafka@madkom.pl>
 */
class AppointmentFactory
{
    /**
     * @var AgreementRepository
     */
    private $agreementRepository;
    /**
     * @var Clock
     */
    private $clock;
    /**
     * @var UuidGenerator
     */
    private $uuidGenerator;
    /**
     * @var Specification
     */
    private $specification;

    /**
     * AppointmentFactory constructor.
     * @param AgreementRepository $agreementRepository
     * @param Clock $clock
     * @param UuidGenerator $uuidGenerator
     * @param Specification $specification
     */
    public function __construct(AgreementRepository $agreementRepository, Clock $clock, UuidGenerator $uuidGenerator, Specification $specification)
    {
        $this->agreementRepository = $agreementRepository;
        $this->clock = $clock;
        $this->uuidGenerator = $uuidGenerator;
        $this->specification = $specification;
    }

    /**
     * @param string $agreementId
     * @param string $startAt
     * @param string $endAt
     * @return Appointment
     */
    public function createWith(string $agreementId, string $startAt, string $endAt) : Appointment
    {
        $startAtImmutable = $this->clock->createFrom($startAt);
        $endAtImmutable = $this->clock->createFrom($endAt);
        $agreement = $this->agreementRepository->findBy($agreementId);

        if ($this->clock->isInPast($startAtImmutable)) {
            throw new \DomainException("Can't create appointment in past");
        }

        if (!$agreement) {
            throw new \DomainException("Can't create appointment, agreement with id {$agreementId} does not exists.");
        }

        $appointment =  new Appointment(
            $this->uuidGenerator->generateUuid(),
            $agreement->organizerId(),
            $agreement->invitedPersonId(),
            $agreement->agreementId(),
            AppointmentTimeFrame::create(
                $startAtImmutable,
                $endAtImmutable
            )
        );

        if (!$this->specification->isSatisfied($appointment)) {
            throw new \DomainException("Appointment can't be created");
        }

        return $appointment;
    }
}

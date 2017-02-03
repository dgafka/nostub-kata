<?php

namespace spec\Madkom\Appointment;

use Feature\NoteMother;
use Madkom\Agreement\Agreement;
use Madkom\Agreement\AgreementRepository;
use Madkom\Appointment\Appointment;
use Madkom\Appointment\AppointmentFactory;
use Madkom\Clock;
use Madkom\Specification;
use Madkom\UuidGenerator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ramsey\Uuid\Uuid;

/**
 * Class AppointmentFactorySpec
 * @package spec\Madkom\Appointment
 * @author Dariusz Gafka <d.gafka@madkom.pl>
 * @mixin AppointmentFactory
 */
class AppointmentFactorySpec extends ObjectBehavior
{
    function let(AgreementRepository $agreementRepository, Clock $clock, UuidGenerator $uuidGenerator, Specification $appointmentSpecification)
    {
        $this->beConstructedWith($agreementRepository, $clock, $uuidGenerator, $appointmentSpecification);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(AppointmentFactory::class);
    }

    function it_should_create_appointment(
        AgreementRepository $agreementRepository, Clock $clock, UuidGenerator $uuidGenerator, Specification $appointmentSpecification,
        Agreement $agreement
    )
    {
        $appointmentId = '120af009-89f6-4ed6-bf33-586667838776';
        $agreementId = 'd9ce0146-c830-413b-90e3-6ee9c37b36eb';
        $startAt = '2016-06-06 12:00:00';
        $endAt   = '2016-06-06 14:00:00';
        $startAtImmutable = new \DateTimeImmutable($startAt);
        $endAtImmutable = new \DateTimeImmutable($endAt);
        $invitedPersonId = 'b0290ea9-9ce2-4300-9bf2-e14fd8088712';
        $organizerId = 'e263fe18-36ac-4757-b22f-3d21da48bd24';

        $uuidGenerator->generateUuid()->willReturn(Uuid::fromString($appointmentId));
        $clock->createFrom($startAt)->willReturn($startAtImmutable);
        $clock->createFrom($endAt)->willReturn($endAtImmutable);
        $clock->isInPast($startAtImmutable)->willReturn(false);

        $agreement->agreementId()->willReturn(Uuid::fromString($agreementId));
        $agreement->invitedPersonId()->willReturn(Uuid::fromString($invitedPersonId));
        $agreement->organizerId()->willReturn(Uuid::fromString($organizerId));

        $appointmentSpecification->isSatisfied(Argument::type(Appointment::class))->willReturn(true);
        $agreementRepository->findBy($agreementId)->willReturn($agreement);


        /** @var Appointment $appointment */
        $appointment = $this->createWith($agreementId, $startAt, $endAt);
        $appointment->appointmentId()->toString()->shouldReturn($appointmentId);
        $appointment->agreementId()->toString()->shouldReturn($agreementId);
        $appointment->invitedPersonId()->toString()->shouldReturn($invitedPersonId);
        $appointment->organizerId()->toString()->shouldReturn($organizerId);
    }

    function it_should_throw_exception_if_creating_appointment_in_past(Clock $clock)
    {
        $agreementId = 'd9ce0146-c830-413b-90e3-6ee9c37b36eb';
        $startAt = '2016-06-06 12:00:00';
        $endAt   = '2016-06-06 14:00:00';
        $startAtImmutable = new \DateTimeImmutable($startAt);
        $endAtImmutable = new \DateTimeImmutable($endAt);

        $clock->createFrom($startAt)->willReturn($startAtImmutable);
        $clock->createFrom($endAt)->willReturn($endAtImmutable);
        $clock->isInPast($startAtImmutable)->willReturn(true);

        $this->shouldThrow(\DomainException::class)->during('createWith', [$agreementId, $startAt, $endAt]);
    }

    function it_should_throw_exception_if_not_satisfied(AgreementRepository $agreementRepository, Clock $clock, UuidGenerator $uuidGenerator, Specification $appointmentSpecification,
        Agreement $agreement)
    {
        $appointmentId = '120af009-89f6-4ed6-bf33-586667838776';
        $agreementId = 'd9ce0146-c830-413b-90e3-6ee9c37b36eb';
        $startAt = '2016-06-06 12:00:00';
        $endAt   = '2016-06-06 14:00:00';
        $startAtImmutable = new \DateTimeImmutable($startAt);
        $endAtImmutable = new \DateTimeImmutable($endAt);
        $invitedPersonId = 'b0290ea9-9ce2-4300-9bf2-e14fd8088712';
        $organizerId = 'e263fe18-36ac-4757-b22f-3d21da48bd24';

        $uuidGenerator->generateUuid()->willReturn(Uuid::fromString($appointmentId));
        $clock->createFrom($startAt)->willReturn($startAtImmutable);
        $clock->createFrom($endAt)->willReturn($endAtImmutable);
        $clock->isInPast($startAtImmutable)->willReturn(false);

        $agreement->agreementId()->willReturn(Uuid::fromString($agreementId));
        $agreement->invitedPersonId()->willReturn(Uuid::fromString($invitedPersonId));
        $agreement->organizerId()->willReturn(Uuid::fromString($organizerId));

        $appointmentSpecification->isSatisfied(Argument::type(Appointment::class))->willReturn(false);
        $agreementRepository->findBy($agreementId)->willReturn($agreement);

        $this->shouldThrow(\DomainException::class)->during('createWith', [$agreementId, $startAt, $endAt]);
    }

    function it_should_throw_exception_if_agreement_does_not_exists(AgreementRepository $agreementRepository, Clock $clock)
    {
        $agreementId = 'd9ce0146-c830-413b-90e3-6ee9c37b36eb';
        $startAt = '2016-06-06 12:00:00';
        $endAt   = '2016-06-06 14:00:00';
        $startAtImmutable = new \DateTimeImmutable($startAt);
        $endAtImmutable = new \DateTimeImmutable($endAt);

        $clock->createFrom($startAt)->willReturn($startAtImmutable);
        $clock->createFrom($endAt)->willReturn($endAtImmutable);
        $clock->isInPast($startAtImmutable)->willReturn(false);

        $agreementRepository->findBy($agreementId)->willReturn(null);

        $this->shouldThrow(\DomainException::class)->during('createWith', [$agreementId, $startAt, $endAt]);
    }
}

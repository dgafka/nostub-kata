<?php


namespace Madkom\Agreement;

use Ramsey\Uuid\Uuid;

/**
 * Class Agreement
 * @package Madkom\Agreement
 * @author Dariusz Gafka <d.gafka@madkom.pl>
 */
class Agreement
{
    /**
     * @var Uuid
     */
    private $agreementId;
    /**
     * @var Uuid
     */
    private $organizerId;
    /**
     * @var Uuid
     */
    private $invitedPersonId;
    /**
     * @var string
     */
    private $description;
    /**
     * @var array
     */
    private $notes;

    /**
     * Agreement constructor.
     * @param Uuid $agreementId
     * @param Uuid $organizerId
     * @param Uuid $invitedPersonId
     * @param string $description
     * @param array $notes
     */
    public function __construct(Uuid $agreementId, Uuid $organizerId, Uuid $invitedPersonId, string $description, array $notes)
    {
        $this->agreementId = $agreementId;
        $this->organizerId = $organizerId;
        $this->invitedPersonId = $invitedPersonId;
        $this->description = $description;
        $this->notes = $notes;
    }

    /**
     * @return Uuid
     */
    public function agreementId() : Uuid
    {
        return $this->agreementId;
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
}
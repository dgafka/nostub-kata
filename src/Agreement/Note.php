<?php


namespace Madkom\Agreement;

/**
 * Class Note
 * @package Madkom\Agreement
 * @author Dariusz Gafka <d.gafka@madkom.pl>
 */
class Note
{
    /**
     * @var string
     */
    private $description;
    /**
     * @var NoteType
     */
    private $noteType;

    /**
     * Note constructor.
     * @param string $description
     * @param NoteType $noteType
     */
    public function __construct(string $description, NoteType $noteType)
    {
        $this->description = $description;
        $this->noteType = $noteType;
    }
}
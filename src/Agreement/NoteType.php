<?php


namespace Madkom\Agreement;

/**
 * Class NoteType
 * @package Madkom\Agreement
 * @author Dariusz Gafka <d.gafka@madkom.pl>
 */
class NoteType
{
    const GOVERNMENT_NOTE = 1;
    const USELESS_NOTE = 2;
    /**
     * @var int
     */
    private $noteType;

    /**
     * NoteType constructor.
     * @param int $noteType
     */
    private function __construct(int $noteType)
    {
        $this->noteType = $noteType;
    }

    /**
     * @param int $noteType
     * @return NoteType
     */
    public static function create(int $noteType) : self
    {
        if ($noteType !== self::GOVERNMENT_NOTE && $noteType !== self::USELESS_NOTE) {
            throw new \DomainException("Not known note type {$noteType}");
        }

        return new self($noteType);
    }
}
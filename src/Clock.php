<?php


namespace Madkom;

/**
 * Interface Clock
 * @package Madkom
 * @author Dariusz Gafka <d.gafka@madkom.pl>
 */
interface Clock
{
    /**
     * @param \DateTimeImmutable $dateTime
     * @return bool
     */
    public function isInPast(\DateTimeImmutable $dateTime) : bool;

    /**
     * @param string $dateTime
     * @return \DateTimeImmutable
     */
    public function createFrom(string $dateTime) : \DateTimeImmutable;
}
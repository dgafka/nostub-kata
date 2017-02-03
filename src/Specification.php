<?php


namespace Madkom;

/**
 * Interface Specification
 * @package Madkom
 * @author Dariusz Gafka <d.gafka@madkom.pl>
 */
interface Specification
{
    /**
     * @param object $object
     * @return bool
     */
    public function isSatisfied($object) : bool;
}
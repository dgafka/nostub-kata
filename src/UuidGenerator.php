<?php


namespace Madkom;

use Ramsey\Uuid\Uuid;

/**
 * Interface UuidGenerator
 * @package Madkom
 * @author Dariusz Gafka <d.gafka@madkom.pl>
 */
interface UuidGenerator
{
    /**
     * @return Uuid
     */
    public function generateUuid() : Uuid;
}
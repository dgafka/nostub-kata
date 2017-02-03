<?php


namespace Madkom\Agreement;

/**
 * Interface AgreementRepository
 * @package Madkom\Agreement
 * @author Dariusz Gafka <d.gafka@madkom.pl>
 */
interface AgreementRepository
{
    /**
     * @param Agreement $agreement
     * @return void
     */
    public function save(Agreement $agreement);

    /**
     * @param string $id
     * @return Agreement|null
     */
    public function findBy(string $id);
}
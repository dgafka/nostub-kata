<?php

namespace Feature;

use Madkom\Agreement\NoteType;

/**
 * Class NoteMother
 * @package Feature
 * @author Dariusz Gafka <d.gafka@madkom.pl>
 */
class NoteMother
{
    /**
     * @return NoteBuilder
     */
    public static function governmentNote() : NoteBuilder
    {
        return NoteBuilder::start()
                ->withDescription('someDescription')
                ->withNoteType(NoteType::GOVERNMENT_NOTE);
    }
}
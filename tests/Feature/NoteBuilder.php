<?php


namespace Feature;

use Madkom\Agreement\Note;
use Madkom\Agreement\NoteType;

/**
 * Class NoteBuilder
 * @package Feature
 * @author Dariusz Gafka <d.gafka@madkom.pl>
 */
class NoteBuilder
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
     * @return NoteBuilder
     */
    public static function start() : self
    {
        return new self();
    }

    /**
     * @param string $description
     * @return NoteBuilder
     */
    public function withDescription(string $description) : self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @param int $noteType
     * @return NoteBuilder
     */
    public function withNoteType(int $noteType) : self
    {
        $this->noteType = NoteType::create($noteType);

        return $this;
    }

    /**
     * @return Note
     */
    public function build() : Note
    {
        return new Note($this->description, $this->noteType);
    }
}
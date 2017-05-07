<?php

namespace App\Common\Document\Concern\ValueObjects;

use App\Common\Vote\Concern\ValueObjects\Voice;

class ParsedVoter
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var Voice
     */
    private $voice;

    /**
     * ParsedVoter constructor.
     * @param string $name
     * @param Voice $voice
     */
    public function __construct(string $name, Voice $voice)
    {
        $this->name = $name;
        $this->voice = $voice;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Voice
     */
    public function getVoice(): Voice
    {
        return $this->voice;
    }
}

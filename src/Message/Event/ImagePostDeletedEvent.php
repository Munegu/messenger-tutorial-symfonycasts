<?php


namespace App\Message\Event;


class ImagePostDeletedEvent
{
    /**
     * @var string
     */
    private $filename;

    /**
     * ImagePostDeletedEvent constructor.
     * @param string $filename
     */
    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    /**
     * @return string
     */
    public function getFilename(): string
    {
        return $this->filename;
    }


}
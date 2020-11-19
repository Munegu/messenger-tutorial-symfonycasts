<?php


namespace App\Message\Command;


class AddPonkaToImage
{
    /**
     * @var int
     */
    private $imagePostId;

    /**
     * AddPonkaToImage constructor.
     */
    public function __construct(int $imagePostId)
    {
        $this->imagePostId = $imagePostId;
    }

    /**
     * @return int
     */
    public function getImagePostId(): int
    {
        return $this->imagePostId;
    }


}
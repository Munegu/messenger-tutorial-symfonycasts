<?php


namespace App\MessageHandler;


use App\Message\AddPonkaToImage;
use App\Photo\PhotoFileManager;
use App\Photo\PhotoPonkaficator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class AddPonkaToImageHandler implements MessageHandlerInterface
{
    /**
     * @var PhotoPonkaficator
     */
    private $ponkaficator;
    /**
     * @var PhotoFileManager
     */
    private $photoManager;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;


    /**
     * AddPonkaToImageHandler constructor.
     * @param PhotoPonkaficator $ponkaficator
     * @param PhotoFileManager $photoManager
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(PhotoPonkaficator $ponkaficator, PhotoFileManager $photoManager, EntityManagerInterface  $entityManager)
    {
        $this->ponkaficator = $ponkaficator;
        $this->photoManager = $photoManager;
        $this->entityManager = $entityManager;
    }

    public function __invoke(AddPonkaToImage $addPonkaToImage)
    {
        $imagePost = $addPonkaToImage->getImagePost();
        /*
       * Start Ponkafication!
       */
        $updatedContents = $this->ponkaficator->ponkafy(
            $this->photoManager->read($imagePost->getFilename())
        );
        $this->photoManager->update($imagePost->getFilename(), $updatedContents);
        $imagePost->markAsPonkaAdded();
        $this->entityManager->flush();
        /*
         * You've been Ponkafied!
         */
    }


}
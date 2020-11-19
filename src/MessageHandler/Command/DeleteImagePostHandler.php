<?php


namespace App\MessageHandler\Command;


use App\Message\Command\DeleteImagePost;
use App\Message\Event\ImagePostDeletedEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class DeleteImagePostHandler implements MessageHandlerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var MessageBusInterface
     */
    private $eventBus;


    /**
     * DeleteImagePostHandler constructor.
     * @param MessageBusInterface $eventBus
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(MessageBusInterface $eventBus, EntityManagerInterface $entityManager)
    {
        $this->eventBus = $eventBus;
        $this->entityManager = $entityManager;
    }

    public function __invoke(DeleteImagePost $deleteImagePost)
    {
        $imagePost = $deleteImagePost->getImagePost();

        $filename = $imagePost->getFilename();


        $this->entityManager->remove($imagePost);
        $this->entityManager->flush();

        $this->eventBus->dispatch(new ImagePostDeletedEvent($filename));
    }

}
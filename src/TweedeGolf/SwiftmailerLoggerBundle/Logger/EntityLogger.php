<?php

namespace TweedeGolf\SwiftmailerLoggerBundle\Logger;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Psr\Log\AbstractLogger;
use Swift_Events_SendEvent;
use TweedeGolf\SwiftmailerLoggerBundle\Entity\LoggedMessage;

class EntityLogger implements LoggerInterface
{
    private $doctrine;

    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function log(array $data)
    {
        $sentMessage = $data['message'];

        $loggedMessage = new LoggedMessage();
        $loggedMessage->setMessageFields($sentMessage);
        $loggedMessage->setResult($data['result']);

        $em = $this->doctrine->getManager();
        $em->persist($loggedMessage);
        $em->flush();
    }


}

<?php

namespace TweedeGolf\SwiftmailerLoggerBundle\Util;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Swift_Events_SendEvent;
use TweedeGolf\SwiftmailerLoggerBundle\Entity\Message;

class EntityLogger
{
    private $doctrine;

    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function log(Swift_Events_SendEvent $evt)
    {
        $sentMessage = $evt->getMessage();

        $logMessage = new Message();
        $logMessage->setMessageFields($sentMessage);
        $logMessage->setResult($this->getReadableResult($evt->getResult()));

        $em = $this->doctrine->getManager();
        $em->persist($logMessage);
        $em->flush();
    }

    private function getReadableResult($result)
    {
        if ($result === 1) {
            return 'pending';
        }

        if ($result === 16) {
            return 'success';
        }

        if ($result === 256) {
            return 'tentative';
        }

        if ($result === 4096) {
            return 'failed';
        }

        return 'unknown';
    }
}

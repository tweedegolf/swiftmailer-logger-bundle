<?php

namespace TweedeGolf\SwiftmailerLoggerBundle\Logger;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Swift_Events_SendEvent;
use TweedeGolf\SwiftmailerLoggerBundle\Entity\LoggedMessage;

class EntityLogger implements LoggerInterface
{
    public function log(Swift_Events_SendEvent $evt)
    {
        // todo: write implementation
    }
}

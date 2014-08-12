<?php

namespace TweedeGolf\SwiftmailerLoggerBundle\EventListener;

use Swift_Events_SendEvent;
use Swift_Events_SendListener;
use TweedeGolf\SwiftmailerLoggerBundle\Util\EntityLogger;

/**
 * Class SendListener
 * @package TweedeGolf\SwiftmailerLoggerBundle\EventListener
 */
class SendListener implements Swift_Events_SendListener
{
    private $entityLogger;

    private $logToEntity;

    private $logToFile;

    public function __construct(EntityLogger $entityLogger, $logToEntity, $logToFile)
    {
        $this->entityLogger = $entityLogger;
        $this->logToEntity = $logToEntity;
        $this->logToFile = $logToFile;
    }

    /**
     * Invoked immediately before the Message is sent.
     *
     * @param Swift_Events_SendEvent $evt
     */
    public function beforeSendPerformed(Swift_Events_SendEvent $evt){}

    /**
     * Invoked immediately after the Message is sent.
     *
     * @param Swift_Events_SendEvent $evt
     */
    public function sendPerformed(Swift_Events_SendEvent $evt)
    {
        if ($this->logToEntity) {
            $this->entityLogger->log($evt);
        }
    }
}

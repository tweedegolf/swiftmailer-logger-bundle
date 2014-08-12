<?php

namespace TweedeGolf\SwiftmailerLoggerBundle\EventListener;

use Swift_Events_SendEvent;
use Swift_Events_SendListener;
use TweedeGolf\SwiftmailerLoggerBundle\Logger\LoggerInterface;

/**
 * Class SendListener
 * @package TweedeGolf\SwiftmailerLoggerBundle\EventListener
 */
class SendListener implements Swift_Events_SendListener
{
    private $loggers;

    public function __construct($loggers)
    {
        $this->loggers = $loggers;
    }

    /**
     * Invoked immediately before the Message is sent.
     *
     * @param Swift_Events_SendEvent $evt
     */
    public function beforeSendPerformed(Swift_Events_SendEvent $evt){}

    /**
     * Log the event with each logger that was passed to this service
     *
     * @param Swift_Events_SendEvent $evt
     */
    public function sendPerformed(Swift_Events_SendEvent $evt)
    {
        /** @var $logger LoggerInterface */
        foreach($this->loggers as $logger) {
            $logger->log($evt);
        }
    }
}

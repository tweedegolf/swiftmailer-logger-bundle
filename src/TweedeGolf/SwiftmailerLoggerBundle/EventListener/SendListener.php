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
    /**
     * @var array containing LoggerInterface objects
     */
    private $loggers = [];

    public function addLogger(LoggerInterface $logger)
    {
        $this->loggers[] = $logger;
    }

    /**
     * Invoked immediately before the Message is sent.
     *
     * @param Swift_Events_SendEvent $evt
     */
    public function beforeSendPerformed(Swift_Events_SendEvent $evt)
    {
        // not used
    }

    /**
     * Log the event with each logger that was passed to this service
     *
     * @param Swift_Events_SendEvent $evt
     */
    public function sendPerformed(Swift_Events_SendEvent $evt)
    {
        $data = [
            'message' => $evt->getMessage(),
            'result' => $this->getReadableResult($evt)
        ];

        /** @var $logger LoggerInterface */
        foreach($this->loggers as $logger) {
            $logger->log($data);
        }
    }

    /**
     * Turns the event result into a human readable string
     *
     * @param Swift_Events_SendEvent $evt
     * @return string
     */
    private  function getReadableResult(Swift_Events_SendEvent $evt)
    {
        $result = $evt->getResult();

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

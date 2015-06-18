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

    /**
     * @param LoggerInterface $logger
     */
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
     * Log the event with each logger that was passed to this service. When spooling, Swift Mailer
     * dispatches the sendPerformed event twice, in that case, only log the second sendPerformed event
     *
     * @param Swift_Events_SendEvent $evt
     * @return bool
     */
    public function sendPerformed(Swift_Events_SendEvent $evt)
    {
        $message = $evt->getMessage();

        // do nothing with a spooled messages, there comes a second send event
        if ($this->getReadableResult($evt) === 'spooled') {
            return false;
        }

        $data = [
            'message' => $message,
            'result' => $this->getReadableResult($evt),
            'failed_recipients' => $evt->getFailedRecipients()
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
    private function getReadableResult(Swift_Events_SendEvent $evt)
    {
        $result = $evt->getResult();

        if ($result === 1) {
            return 'pending';
        }

        if ($result === 16) {
            return 'success';
        }

        if ($result === 17) {
            return 'spooled';
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

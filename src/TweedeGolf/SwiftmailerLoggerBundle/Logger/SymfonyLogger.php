<?php

namespace TweedeGolf\SwiftmailerLoggerBundle\Logger;

use Psr\Log\LoggerInterface as PsrLoggerInterface;

/**
 * Class SymfonyLogger
 * @package TweedeGolf\SwiftmailerLoggerBundle\Logger
 *
 * Responsible for logging the data passed by the SendListener using Symfony logging (monolog).
 */
class SymfonyLogger implements LoggerInterface
{
    /**
     * @var PsrLoggerInterface
     */
    private $logger;

    /**
     * @param PsrLoggerInterface $logger
     */
    public function __construct(PsrLoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param array $data
     */
    public function log(array $data)
    {
        $this->logger->addInfo(\sprintf(
            'from: %s; reply-to: %s; return-path: %s; to: %s; cc: %s; bcc: %s; subject: %s; date: %s',
            $data['message']->getFrom(),
            $data['message']->getReplyTo(),
            $data['message']->getReturnPath(),
            $data['message']->getTo(),
            $data['message']->getCc(),
            $data['message']->getBcc(),
            $data['message']->getSubject(),
            $data['message']->getDate()->format('d.m.Y - H:i:s')
        ));
    }
}

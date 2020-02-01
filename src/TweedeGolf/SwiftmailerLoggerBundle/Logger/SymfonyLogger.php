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
        /** @var \Swift_Message $swiftMessage */
        $swiftMessage = $data['message'];

        $this->logger->addInfo(\sprintf(
            'MAIL SENT - from: %s; reply-to: %s; return-path: %s; to: %s; cc: %s; bcc: %s; subject: %s; date: %s',
            $this->getStringValue($swiftMessage->getFrom()),
            $this->getStringValue($swiftMessage->getReplyTo()),
            $this->getStringValue($swiftMessage->getReturnPath()),
            $this->getStringValue($swiftMessage->getTo()),
            $this->getStringValue($swiftMessage->getCc()),
            $this->getStringValue($swiftMessage->getBcc()),
            $data['message']->getSubject(),
            $data['message']->getDate()->format('d.m.Y - H:i:s')
        ));
    }

    /**
     * @param mixed $fieldValue
     * @return string
     */
    private function getStringValue($fieldValue)
    {
        if (\is_string($fieldValue)) {
            return $fieldValue;
        } else if (\is_array($fieldValue)) {
            $fromStrings = [];

            foreach ($fieldValue as $prefix => $suffix) {
                $fromStrings[] = (empty($suffix)) ? $prefix : $prefix.'<'.$suffix.'>';
            }

            return \implode(', ', $fromStrings);
        }
    }
}

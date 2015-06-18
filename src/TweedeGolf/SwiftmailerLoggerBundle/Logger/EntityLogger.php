<?php

namespace TweedeGolf\SwiftmailerLoggerBundle\Logger;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Monolog\Logger;
use TweedeGolf\SwiftmailerLoggerBundle\Entity\LoggedMessage;

/**
 * Class EntityLogger
 * @package TweedeGolf\SwiftmailerLoggerBundle\Logger
 *
 * Responsible for logging the data passed by the SendListener using the LoggedMessage entity
 */
class EntityLogger implements LoggerInterface
{
    /**
     * @var \Doctrine\Bundle\DoctrineBundle\Registry
     */
    private $doctrine;

    /**
     * @var \Monolog\Logger
     */
    private $logger;

    /**
     * @param Registry $doctrine
     * @param Logger $logger
     */
    public function __construct(Registry $doctrine, Logger $logger)
    {
        $this->doctrine = $doctrine;
        $this->logger = $logger;
    }

    /**
     * @param array $data
     */
    public function log(array $data)
    {
        $loggedMessage = new LoggedMessage();
        $loggedMessage->setMessageFields($data['message']);
        $loggedMessage->setResult($data['result']);
        $loggedMessage->setFailedRecipients($data['failed_recipients']);

        $em = $this->doctrine->getManager();

        // application should not crash when logging fails
        try {
            $em->persist($loggedMessage);
            $em->flush($loggedMessage);
        } catch (\Exception $e) {
            $message = 'Logging sent message with TweedeGolf\SwiftmailerLoggerBundle\Logger\EntityLogger failed: ' .
                $e->getMessage();
            $this->logger->addError($message);
        }
    }
}

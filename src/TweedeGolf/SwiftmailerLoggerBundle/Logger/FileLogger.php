<?php

namespace TweedeGolf\SwiftmailerLoggerBundle\Logger;

use Monolog\Logger;
use Swift_Message;
use TweedeGolf\SwiftmailerLoggerBundle\Entity\LoggedMessage;

class FileLogger implements LoggerInterface
{
    private $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function log(array $data)
    {
        /** @var Swift_Message $message */
        $message = $data['message'];
        $from = 'test';
        $message = sprintf("Email send from %s", $from);
        $this->logger->addInfo($message);
        var_dump('Logged it');
        var_dump($this->logger->getHandlers());
    }
}

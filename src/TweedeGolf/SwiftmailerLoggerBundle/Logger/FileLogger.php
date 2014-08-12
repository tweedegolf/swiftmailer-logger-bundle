<?php

namespace TweedeGolf\SwiftmailerLoggerBundle\Logger;

use Monolog\Logger;
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
        $this->logger->log(100, 'blaat');
    }
}

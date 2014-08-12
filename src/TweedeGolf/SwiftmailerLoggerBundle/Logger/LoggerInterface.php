<?php

namespace TweedeGolf\SwiftmailerLoggerBundle\Logger;

use Swift_Events_SendEvent;

/**
 * Interface that all loggers in the Logger namespace should implement
 */
interface LoggerInterface {

    public function log(array $data);
}
<?php

namespace TweedeGolf\SwiftmailerLoggerBundle\Logger;

use Swift_Events_SendEvent;

/**
 * Interface that all loggers in the Logger namespace should implement
 */
interface LoggerInterface {

    public function log(Swift_Events_SendEvent $evt);
}
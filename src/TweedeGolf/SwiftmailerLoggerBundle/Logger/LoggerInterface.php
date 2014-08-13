<?php

namespace TweedeGolf\SwiftmailerLoggerBundle\Logger;

/**
 * Interface that all loggers in the Logger namespace should implement
 */
interface LoggerInterface {

    public function log(array $data);
}
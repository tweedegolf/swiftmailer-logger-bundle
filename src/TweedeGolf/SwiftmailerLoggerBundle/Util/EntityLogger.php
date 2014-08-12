<?php

namespace TweedeGolf\SwiftmailerLoggerBundle\Util;

use Doctrine\Bundle\DoctrineBundle\Registry;

class EntityLogger
{
    private $doctrine;

    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }
}

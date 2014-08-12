<?php

namespace TweedeGolf\SwiftmailerLoggerBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use TweedeGolf\SwiftmailerLoggerBundle\DependencyInjection\RegisterSendListenerCompilerPass;

class TweedeGolfSwiftmailerLoggerBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new RegisterSendListenerCompilerPass());
    }
}

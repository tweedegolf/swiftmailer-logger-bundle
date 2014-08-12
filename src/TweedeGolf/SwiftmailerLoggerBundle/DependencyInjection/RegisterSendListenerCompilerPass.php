<?php

namespace TweedeGolf\SwiftmailerLoggerBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class RegisterSendListenerCompilerPass implements CompilerPassInterface
{

    public function process(ContainerBuilder $container)
    {
        if ($container->hasDefinition('swiftmailer.mailer.default')) {
            $def = $container->getDefinition('swiftmailer.mailer.default');
            $def->addMethodCall('registerPlugin', array(new Reference('tweedegolf_swiftmailer_logger.send_listener')));
            unset($def);
        }
    }

}

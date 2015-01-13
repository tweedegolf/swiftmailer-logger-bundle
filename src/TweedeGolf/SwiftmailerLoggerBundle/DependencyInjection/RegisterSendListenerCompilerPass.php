<?php

namespace TweedeGolf\SwiftmailerLoggerBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class RegisterSendListenerCompilerPass
 * @package TweedeGolf\SwiftmailerLoggerBundle\DependencyInjection
 */
class RegisterSendListenerCompilerPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        // bind listener to mailer instances
        if($container->hasParameter('tweedegolf_swiftmailer_logger.swift_instances')){ // if instances are explicitly declared
            
            $instances = $container->getParameter('tweedegolf_swiftmailer_logger.swift_instances');
            foreach($instances as $instance){
                if($container->hasDefinition('swiftmailer.mailer.' . $instance)){
                    $def = $container->getDefinition('swiftmailer.mailer.' . $instance);
                    $def->addMethodCall('registerPlugin', array(new Reference('tweedegolf_swiftmailer_logger.send_listener')));
                    unset($def);
                }
            }
            
        }else if ($container->hasDefinition('swiftmailer.mailer.default')) { // default instance only

            $def = $container->getDefinition('swiftmailer.mailer.default');
            $def->addMethodCall('registerPlugin', array(new Reference('tweedegolf_swiftmailer_logger.send_listener')));
            unset($def);
        }
    }
}

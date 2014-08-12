<?php

namespace TweedeGolf\SwiftmailerLoggerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction($name)
    {
        return array('name' => $name);
    }

    /**
     * Sends example message
     * @Route("/send")
     * @Template()
     */
    public function sendAction()
    {
        //todo load message fixtures to test repeatedly

        //todo hook listerner on kernel request that gets swiftmailer mailer as an argument
        //and registers a "plugin" that implements Swift_Events_EventListener

        $email = \Swift_Message::newInstance();
        $email->setTo("hugo+1@tweedegolf.com");
        $email->setSubject('Subject');
        $email->setFrom("support@tweedegolf.com");
        $email->setBody("body");
        $email->setBcc("hugo+bcc@tweedegolf.com");

        $sent = $this->container->get('mailer')->send($email);

        return ['sent' => $sent];
    }
}

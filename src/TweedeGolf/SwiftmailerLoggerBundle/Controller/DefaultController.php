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
        $email = \Swift_Message::newInstance();
        $email->setTo(['hugovandepol@gmail.com' => 'Hugo', 'hugo@tweedegolf.com' => 'blaat']);
        $email->setSubject('Subject');
        $email->setFrom(["support@tweedegolf.com" => "blaat"], 'kaas');
        $email->setReturnPath('support@blaat.com');
        $email->setBody("body");
        $email->setBcc(["hugo+bcc@tweedegolf.com" => 'H', 'swag@gmail.com' => 's']);

        $sent = $this->container->get('mailer')->send($email);

        return ['sent' => $sent];
    }
}

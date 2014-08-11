<?php

namespace spec\TweedeGolf\SwiftmailerLoggerBundle\Entity;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;


class MessageSpec extends ObjectBehavior
{
    function it_is_of_the_correct_type()
    {
        $this->shouldHaveType('tweedegolf\SwiftMailerLoggerBundle\Entity\Message');
    }

    function its_from_email_should_be_modifiable()
    {
        $email = 'hugo@tweedegolf.com';
        $this->setFromEmail($email);
        $this->getFromEmail()->shouldReturn($email);
    }

    function its_to_email_should_be_modifiable()
    {
        $email = 'hugo@tweedegolf.com';
        $this->setToEmail($email);
        $this->getToEmail()->shouldReturn($email);
    }

    function its_generated_id_should_be_modifiable()
    {
        $id = '<c83ce37b1f99ce526eb40ffce9440f75>';
        $this->setGeneratedId($id);
        $this->getGeneratedId()->shouldReturn($id);
    }

    function its_to_return_path_should_be_modifiable()
    {
        $email = 'hugo@tweedegolf.com';
        $this->setReturnPath($email);
        $this->getReturnPath()->shouldReturn($email);
    }

    function its_reply_to_email_should_be_modifiable()
    {
        $email = 'hugo@tweedegolf.com';
        $this->setReplyToEmail($email);
        $this->getReplyToEmail()->shouldReturn($email);
    }

    function its_cc_should_be_modifiable()
    {
        $email = 'hugo@tweedegolf.com';
        $this->setCc($email);
        $this->getCc()->shouldReturn($email);
    }

    function its_bcc_should_be_modifiable()
    {
        $email = 'hugo@tweedegolf.com';
        $this->setBcc($email);
        $this->getBcc()->shouldReturn($email);
    }

    function its_subject_should_be_modifiable()
    {
        $subject = 'This could be a really long subject too';
        $this->setSubject($subject);
        $this->getSubject()->shouldReturn($subject);
    }

    function its_date_should_be_modifiable()
    {
        $date = new \DateTime();
        $this->setDate($date);
        $this->getDate()->shouldReturn($date);
    }

    function its_charset_should_be_modifiable()
    {
        $charset = 'some-charset';
        $this->setCharset($charset);
        $this->getCharset()->shouldReturn($charset);
    }

    function its_priority_should_be_modifiable()
    {
        $priority = 1;
        $this->setPriority($priority);
        $this->getPriority()->shouldReturn($priority);
    }
}

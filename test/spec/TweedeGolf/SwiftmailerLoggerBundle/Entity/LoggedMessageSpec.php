<?php

namespace spec\TweedeGolf\SwiftmailerLoggerBundle\Entity;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;


class LoggedMessageSpec extends ObjectBehavior
{
    function it_is_of_the_correct_type()
    {
        $this->shouldHaveType('tweedegolf\SwiftMailerLoggerBundle\Entity\LoggedMessage');
    }

    function its_from_email_should_be_modifiable()
    {
        $email = 'hugo@tweedegolf.com';
        $this->setFrom($email);
        $this->getFrom()->shouldReturn($email);
    }

    function its_to_email_should_be_modifiable()
    {
        $email = ['hugo@tweedegolf.com'];
        $this->setTo($email);
        $this->getTo()->shouldReturn($email);
    }

    function its_generated_id_should_be_modifiable()
    {
        $id = '<c83ce37b1f99ce526eb40ffce9440f75>';
        $this->setGeneratedId($id);
        $this->getGeneratedId()->shouldReturn($id);
    }

    function its_return_path_should_be_modifiable()
    {
        $email = 'hugo@tweedegolf.com';
        $this->setReturnPath($email);
        $this->getReturnPath()->shouldReturn($email);
    }

    function its_reply_to_email_should_be_modifiable()
    {
        $email = 'hugo@tweedegolf.com';
        $this->setReplyTo($email);
        $this->getReplyTo()->shouldReturn($email);
    }

    function its_cc_should_be_modifiable()
    {
        $email = ['hugo@tweedegolf.com'];
        $this->setCc($email);
        $this->getCc()->shouldReturn($email);
    }

    function its_bcc_should_be_modifiable()
    {
        $email = ['hugo@tweedegolf.com'];
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

    function its_body_should_be_modifieable()
    {
        $body = 'some body';
        $this->setBody($body);
        $this->getBody()->shouldReturn($body);
    }

    function its_result_should_be_modifiable()
    {
        $result = 'success';
        $this->setResult($result);
        $this->getResult()->shouldReturn($result);
    }
}

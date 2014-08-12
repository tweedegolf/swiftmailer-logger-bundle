<?php

namespace TweedeGolf\SwiftmailerLoggerBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping as ORM;
use Swift_Mime_Message;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Message
 *
 * @package TweedeGolf\SwiftmailerLoggerBundle\Entity
 *
 * @Entity
 * @Table(name="tweedegolf_logged_message")
 */
class Message
{
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @var array
     *
     * @ORM\Column(type="array", nullable=false)
     * @Assert\NotNull()
     * @Assert\NotBlank()
     */
    private $fromEmail;

    /**
     * @var array
     *
     * @ORM\Column(type="array", nullable=false)
     * @Assert\NotNull()
     * @Assert\NotBlank()
     */
    private $toEmail;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\NotNull()
     * @Assert\NotBlank()
     */
    private $generatedId;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $returnPath;

    /**
     * @var array
     *
     * @ORM\Column(type="array", nullable=true)
     */
    private $replyToEmail;

    /**
     * @var array
     *
     * @ORM\Column(type="array", nullable=true)
     */
    private $cc;

    /**
     * @var array
     *
     * @ORM\Column(type="array", nullable=true)
     */
    private $bcc;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $subject;

    /**
     * @var DateTime
     *
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $charset;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $priority;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=false)
     */
    private $body;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=127, nullable = false)
     * @Assert\NotNull()
     * @Assert\NotBlank()
     */
    private $result;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param array $bcc
     */
    public function setBcc($bcc)
    {
        $this->bcc = $bcc;
    }

    /**
     * @return array
     */
    public function getBcc()
    {
        return $this->bcc;
    }

    /**
     * @param string $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param array $cc
     */
    public function setCc($cc)
    {
        $this->cc = $cc;
    }

    /**
     * @return array
     */
    public function getCc()
    {
        return $this->cc;
    }

    /**
     * @param string $charset
     */
    public function setCharset($charset)
    {
        $this->charset = $charset;
    }

    /**
     * @return string
     */
    public function getCharset()
    {
        return $this->charset;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $fromEmail
     */
    public function setFromEmail($fromEmail)
    {
        $this->fromEmail = $fromEmail;
    }

    /**
     * @return string
     */
    public function getFromEmail()
    {
        return $this->fromEmail;
    }

    /**
     * @param string $generatedId
     */
    public function setGeneratedId($generatedId)
    {
        $this->generatedId = $generatedId;
    }

    /**
     * @return string
     */
    public function getGeneratedId()
    {
        return $this->generatedId;
    }

    /**
     * @param int $priority
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    }

    /**
     * @return int
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param string $replyToEmail
     */
    public function setReplyToEmail($replyToEmail)
    {
        $this->replyToEmail = $replyToEmail;
    }

    /**
     * @return string
     */
    public function getReplyToEmail()
    {
        return $this->replyToEmail;
    }

    /**
     * @param string $returnPath
     */
    public function setReturnPath($returnPath)
    {
        $this->returnPath = $returnPath;
    }

    /**
     * @return string
     */
    public function getReturnPath()
    {
        return $this->returnPath;
    }

    /**
     * @param string $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string $toEmail
     */
    public function setToEmail($toEmail)
    {
        $this->toEmail = $toEmail;
    }

    /**
     * @return string
     */
    public function getToEmail()
    {
        return $this->toEmail;
    }

    /**
     * @param string $result
     */
    public function setResult($result)
    {
        $this->result = $result;
    }

    /**
     * @return string
     */
    public function getResult()
    {
        return $this->result;
    }

    public function setMessageFields(Swift_Mime_Message $message)
    {
        $date = new DateTime();
        $this->setDate($date->setTimestamp($message->getDate()));
        $this->setFromEmail($message->getFrom());
        $this->setReplyToEmail($message->getReplyTo());
        $this->setReturnPath($message->getReturnPath());
        $this->setToEmail($message->getTo());
        $this->setCc($message->getCc());
        $this->setBcc($message->getBcc());
        $this->setSubject($message->getSubject());
        $this->setBody($message->getBody());
        $this->setGeneratedId($message->getId());
    }
}

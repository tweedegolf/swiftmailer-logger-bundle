<?php

namespace TweedeGolf\SwiftmailerLoggerBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class LoggedMessage - represents a logged message
 *
 * Contains most of the properties that can be retrieved from a Swift_Message instance plus some extra
 *
 * @package TweedeGolf\SwiftmailerLoggerBundle\Entity
 * @Entity(repositoryClass="TweedeGolf\SwiftmailerLoggerBundle\Entity\Repository\LoggedMessageRepository")
 * @Table(name="tweedegolf_logged_message")
 */
class LoggedMessage
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
     * @ORM\Column(name="from_field", type="array", length=511, nullable=false)
     * @Assert\NotNull()
     * @Assert\NotBlank()
     */
    private $from;

    /**
     * @var array
     *
     * @ORM\Column(name="to_field", type="array", nullable=false)
     * @Assert\NotNull()
     * @Assert\NotBlank()
     */
    private $to;

    /**
     * @var string Unique identifier of the Swift_Message that was sent
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
     * @ORM\Column(type="array", length=255, nullable=true)
     */
    private $replyTo;

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
     * @ORM\Column(name="subject_field", type="string", length=255, nullable=true)
     */
    private $subject;

    /**
     * @var DateTime
     *
     * Different from the Swift_message date field, which is a timestamp
     *
     * @ORM\Column(name="date_field", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=false)
     */
    private $body;

    /**
     * @var string
     *
     * This is not a Swift_message field but a field to register the sending result
     *
     * @ORM\Column(type="string", length=127, nullable = false)
     * @Assert\NotNull()
     * @Assert\NotBlank()
     */
    private $result;

    /**
     * @var array
     *
     * @ORM\Column(type="array", nullable=true)
     */
    private $failedRecipients;

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
     * @param string $from
     */
    public function setFrom($from)
    {
        $this->from = $from;
    }

    /**
     * @return string
     */
    public function getFrom()
    {
        return $this->from;
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
     * @param string $replyTo
     */
    public function setReplyTo($replyTo)
    {
        $this->replyTo = $replyTo;
    }

    /**
     * @return string
     */
    public function getReplyTo()
    {
        return $this->replyTo;
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
     * @param array $to
     */
    public function setTo($to)
    {
        $this->to = $to;
    }

    /**
     * @return array
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @return array
     */
    public function getFailedRecipients()
    {
        return $this->failedRecipients;
    }

    /**
     * @param array $failedRecipients
     */
    public function setFailedRecipients($failedRecipients)
    {
        $this->failedRecipients = $failedRecipients;
    }

    /**
     * Sets all fields from the passed Swift_Mime_Message instance that will be logged
     *
     * @param Swift_Mime_Message $message
     */
    public function setMessageFields(\Swift_Message $message)
    {
        $date = new DateTime();

        // To prevent a lot of warnings
        $messageDate = $message->getDate();
        if (is_object($messageDate)) {
            $messageDate = $messageDate->getTimestamp();
        }

        $this->setDate($date->setTimestamp($messageDate));
        $this->setFrom($message->getFrom());
        $this->setReplyTo($message->getReplyTo());
        $this->setReturnPath($message->getReturnPath());
        $this->setTo($message->getTo());
        $this->setCc($message->getCc());
        $this->setBcc($message->getBcc());
        $this->setSubject($message->getSubject());
        $this->setBody($message->getBody());
        $this->setGeneratedId($message->getId());
    }
    
    /**
     * Returns a Swift_Message instance that can be sent
     * 
     * @return \Swift_Message
     */
    public function getSwiftMessage(){
        $message = new \Swift_Message();
        $message->setDate($this->getDate()->getTimestamp());
        $message->setFrom($this->getFrom());
        $message->setReplyTo($this->getReplyTo());
        $message->setReturnPath($this->getReturnPath());
        $message->setTo($this->getTo());
        $message->setCc($this->getCc());
        $message->setBcc($this->getBcc());
        $message->setSubject($this->getSubject());
        $message->setBody($this->getBody());

        return $message;
    }
}

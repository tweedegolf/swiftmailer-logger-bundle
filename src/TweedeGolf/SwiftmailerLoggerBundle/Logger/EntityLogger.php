<?php

namespace TweedeGolf\SwiftmailerLoggerBundle\Logger;

use Doctrine\DBAL\DBALException;
use Doctrine\ORM\ORMException;
use \PDOException;
use Doctrine\Bundle\DoctrineBundle\Registry;
use TweedeGolf\SwiftmailerLoggerBundle\Entity\LoggedMessage;

class EntityLogger implements LoggerInterface
{
    private $doctrine;

    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function log(array $data)
    {
        $sentMessage = $data['message'];

        $loggedMessage = new LoggedMessage();
        $loggedMessage->setMessageFields($sentMessage);
        $loggedMessage->setResult($data['result']);

        $em = $this->doctrine->getManager();

        $message = false;

        try {
            $em->persist($loggedMessage);
            $em->flush();
        } catch (PDOException $e) {
            $message = $e->getMessage();
        } catch (DBALException $e) {
            $message = $e->getMessage();
        } catch (ORMException $e) {
            $message = $e->getMessage();
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }

        if ($message !== false) {
            // todo log message
        }

    }


}

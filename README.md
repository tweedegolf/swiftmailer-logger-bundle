# SwiftmailerLoggerBundle

The tweedegolf SwiftmailerLoggerBundle provides an easy way to log messages sent with Swift Mailer. Currently
the bundle only provides an 'entity logger', which uses its `LoggedMessage` Doctrine entity to store
the details of a message that was sent. In the near future, a file logger will be added. Please note that the bundle is a work in progress and pay attention to the issue that was reported on 10-9-2014 about using lifecycle events.

## Installation and configuration

Using [Composer][composer], please run the following command to add the bundle to your composer.json and to install it
immediately:

```
composer require tweedegolf/swiftmailer-logger-bundle:dev-master
```

### Basic configuration
Add the following configuration to your configuration file `app/config/config.yml`:

```
tweede_golf_swiftmailer_logger:
    loggers:
        entity_logger:
            enabled: true
```

This will enable the only logger that is currently available: the entity logger.

### Add the bundle to your AppKernel
Add the bundle in `app/AppKernel.php`, as shown below:

```php
public function registerBundles()
{
    return array(
        // ...
        new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
        new TweedeGolf\SwiftmailerLoggerBundle\TweedeGolfSwiftmailerLoggerBundle(),
        // ...
    );
}
```

### Update your database schema
Finally, update your database schema such that `LoggedMessage` entities can be stored by Doctrine.

## Usage
With the above all set up, logging is automatic. The bundle provides a listener that listens to the
`Swift_Events_SendEvent sendPerformed` event on which it passes on the data to be logged to any loggers configured.


### What is being logged?
Every time an email is sent in your app with Swiftmailer, an LoggedMessage record is written to the database. This record contains the following info
- the from, to, replyTo, cc and bcc address fields, all stored as array type
- the return path (string)
- the subject of the message
- the body of the message
- the date and time that the message was sent
- the sending result
- any failed recipients

Of these, the sending result and failed recipients require some explanation. The sending result always contains one of the following strings "pending", "success", "tentative", "failed" or "unknown"
representing the results (except for "spooled") that a Swift_Events_SendEvent can have. In the failed recipients field recipients are logged for which a
Swift_RfcComplianceException or Swift_TransportException was thrown during sending. Note that a "success" result and no failed recipients *does not mean* that all recipients actually received the
email that was logged: we only no that there were no problems during sending.

### Retrieving logged messages
The bundle provides an empty `LoggedMessage` repository that can be used to retrieve messages logged by the entity logger.
Retrieve it for example in one of your controllers by using:

```
$repo = $this->getDoctrine()->getRepository("TweedeGolfSwiftmailerLoggerBundle:LoggedMessage");

```

### Use multiple or custom instances of Swift mailer
If you are using multiple Swift instances on your application or if you have overwritten the name of your Swift instance, modify your `app/config.yml` as shown below:
```
tweede_golf_swiftmailer_logger:
   swift_instances:
        - default
        - secondary_smtp
        
    loggers:
        entity_logger:
            enabled: true
```

Using multiple Swift instances, your Swiftmailer configuration will look something like this:

```
swiftmailer:
    default_mailer: default
    mailers:
        default:
            transport:  %swift_transport%
            username: %swift_username%
            password: %swift_password%

        secondary_smtp:
            transport:  %swift_transport2%
            username: %swift_username2%
            password: %swift_password2%

```

[composer]: https://getcomposer.org/

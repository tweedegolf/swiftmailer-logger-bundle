# SwiftmailerLoggerBundle

The tweedegolf SwiftmailerLoggerBundle provides an easy way to log messages sent with Swift Mailer. Currently
only the use of the bundle's 'entity_logger' is supported, which uses its `LoggedMessage` entity to store
the details of a message that was sent, using Doctrine.

## Installation and configuration

Using [Composer][composer], please run

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

### Add the bundle to your AppKernel
Finally add the bundle in `app/AppKernel.php`:

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

### Update your datbase schema
The final step is to update your database schema, such that `LoggedMessage` entities can be stored by doctrine.

## Usage
With the above all set up, logging is automatic. The bundle provides a listener that listens to the
`Swift_Events_SendEvent sendPerformed` event on which it passes on the data to be logged to any loggers configured.

[composer]: https://getcomposer.org/

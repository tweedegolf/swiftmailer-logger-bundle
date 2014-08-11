<?php

use Behat\Behat\Definition\Call\Given;
use Behat\Behat\Definition\Call\Then;
use Behat\Behat\Definition\Call\When;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Symfony2Extension\Context\KernelDictionary;

class FeatureContext extends MinkContext
{
    use KernelDictionary;
}
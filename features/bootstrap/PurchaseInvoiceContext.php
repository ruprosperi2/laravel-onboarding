<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class PurchaseInvoiceContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given The request body:
     */
    public function theRequestBody(PyStringNode $string)
    {
        throw new PendingException();
    }

    /**
     * @When I post to :arg1
     */
    public function iPostTo($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then the response reason is :arg1
     */
    public function theResponseReasonIs($arg1)
    {
        throw new PendingException();
    }
}

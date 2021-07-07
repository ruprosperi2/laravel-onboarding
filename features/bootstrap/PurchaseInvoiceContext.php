<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

/**
 * Defines application features from the specific context.
 */
class PurchaseInvoiceContext implements Context
{
    const URL = "http://localhost/";
    private $client;
    private $body;
    private $response;
    private $reason;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->client = new Client([
           "base_uri" => self::URL
        ]);

    }

    /**
     * @Given The request body:
     */
    public function theRequestBody(PyStringNode $body)
    {
        $this->body = $body;
    }

    /**
     * @When I post to :uri
     */
    public function iPostTo($uri)
    {
        $this->response = $this->client->post($uri,[
            RequestOptions::JSON => json_decode($this->body) // Convierte un string codificado en JSON a una variable de PHP
        ]);
    }

    /**
     * @Then the response reason is :message
     */
    public function theResponseReasonIs($message)
    {
        return $this->response->getReasonPhrase() == $message;
    }
}

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
    private $id;

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


    /**
     * @When enter to :uri
     */
    public function enterTo($uri)
    {
        $this->response = $this->client->get($uri);
    }


    /**
     * @Then the response code is :code
     */
    public function theResponseCodeIs($code)
    {
        return $this->response->getStatusCode() == $code;
    }



    /**
     * @Then the response reason phrase is “OK”
     */
    public function theResponseReasonPhraseIsOk()
    {
        if($this->response->getReasonPhrase() != "OK"){
            throw new Exception("Error");
        }
    }

    /**
     * @Given the id: :id
     */
    public function theId($id)
    {
        $this->id = $id;
    }

    /**
     * @When you navigate to :uri
     */
    public function youNavigateTo($uri)
    {
        $route = $uri."/".$this->id;
        $this->response =  json_decode($this->client->get($route)->getBody(), true);

        dd($this->response);

    }


    /**
     * @Then the body is a JSON array of length :arg1
     */
    public function theBodyIsAJsonArrayOfLength($arg1)
    {
        if( count($this->response) != $arg1 ){
            throw new Exception("Result no found");
        }
    }
}

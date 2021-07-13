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
        $this->response =  ($this->client->get($route));

    }

    /**
     * @Then the expected response is a code :code
     */
    public function theExpectedResponseIsACode($code)
    {
        return $this->response->getStatusCode() == $code;
    }


    /**
     * @Then the response body is a array with a length of at least :arg1
     */
    public function theResponseBodyIsAJsonArrayWithALengthOfAtLeast($arg1)
    {
        $array = json_decode($this->response->getBody(), true);
        if( !count($array) >= $arg1 ){
            throw new Exception("Result no found");
        }
    }


    /**
     * @Given I want to delete a purchase with id :id
     */
    public function iWantToDeleteAPurchaseWithId2($id)
    {
        $this->id = $id;
    }

    /**
     * @When you navigate to :uri with the delete method
     */
    public function youNavigateToWithTheDeleteMethod($uri)
    {
        $route = $uri."/".$this->id;
        $this->response =  ($this->client->delete($route));
    }

    /**
     * @Then the expected response is a :arg1
     */
    public function theExpectedResponseIsA($arg1)
    {
        if( $arg1 != "OK"){
            throw new Exception("404 Not Found");
        }
    }



    /**
     * @Given The id :id for update
     */
    public function theIdForUpdate($id)
    {
        $this->id = $id;
    }

    /**
     * @Given The request body for update:
     */
    public function theRequestBodyForUpdate(PyStringNode $body)
    {
        $this->body = $body;
    }

    /**
     * @When you navigate to :uri with the put method
     */
    public function youNavigateToWithThePutMethod($uri)
    {
        $route = $uri."/".$this->id;
        $this->response = $this->client->put($route,[
            RequestOptions::JSON => json_decode($this->body,true) // Convierte un string codificado en JSON a una variable de PHP
        ]);

    }
}

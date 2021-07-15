<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
/**
 * Defines application features from the specific context.
 */
class RequestOrderContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
   const URL = 'http://localhost/';
   private $data;
   private $client;
   private $uri;
   public $response;
   private $result;
   private $deleteId;
   private $change;

    public function __construct()
    {
        $this->client = new Client([
            "base_uri" => self::URL
        ]);
    }

    /**
     * @Given These are the data of the request order:
     */
    public function theseAreTheDataOfTheRequestOrder($data)
    {
        $this->data=$data;
    }

    /**
     * @When I post link :arg1
     */
    public function iPostLink($uri)
    {
        $this->response = $this->client->post($uri, [
            RequestOptions::JSON =>json_decode($this->data)
        ]);
    }

    /**
     * @Then The result will be :arg1
     */
    public function theResultWillBe($result)
    {
        return $this->response->getStatusCode() == $result;
    }
    //read request order
    /**
     * @Given Read the request order in :uri
     */
    public function readTheRequestOrderIn($uri)
    {
        $this->response = $this->client->get($uri);
    }

    /**
     * @Then Read :arg1 request orders
     */
    public function readRequestOrders($number)
    {
            $request = json_decode($this->response->getBody()->getContents(), true);
            return count($request) >= $number;
    }

    /**
     * @Given These are the data to change of the request order:
     */
    public function theseAreTheDataToChangeOfTheRequestOrder($change)
    {
        $this->change=$change;
    }

    /**
     * @When I put link :arg1
     */
    public function iPutLink($uri)
    {
        $this->response = $this->client->put($uri, [
            RequestOptions::JSON => json_decode($this->change, true) ]);
    }

    /**
     * @Given delete request order data :arg1
     */
    public function deleteRequestOrderData($deleteId)
    {
        $this->deleteId=$deleteId;
    }

    /**
     * @When :arg1
     */
    public function stepDefinition1($uri)
    {
        $route = $uri."/".$this->deleteId;
        $this->response =  ($this->client->delete($route));
    }

}

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
class FeatureContext implements Context
{
    const URL = "http://localhost/laravel-onboarding/public/";
    private $client;
    private $body;
    private $action;
    private $response;
    private $editData;
    private $deleteId;
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
     * @Given The request body is:
     */
    public function theRequestBodyIs($body)
    {
        $this->body = $body;
    }

    /**
     * @When I post to :arg1
     */
    public function iPostTo($uri)
    {
        $this->response = $this->client->post($uri, [
            RequestOptions::JSON => json_decode($this->body, true)
        ]);
    }

    /**
     * @Then the response code is :arg1
     */
    public function theResponseCodeIs($code)
    {
        return $this->response->getStatusCode() == $code;
    }

    /**
     * @Given the edit data is:
     */
    public function theEditDataIs($editData)
    {
        $this->editData = $editData;
    }

    /**
     * @When I put to :arg1
     */
    public function iPutTo($uri)
    {
        $this->response = $this->client->put($uri, [
            RequestOptions::JSON => json_decode($this->editData, true)
        ]);
    }

    /**
     * @Given the delete id is :arg1
     */
    public function theDeleteIdIs($id)
    {
        $this->deleteId = $id;
    }

    /**
     * @Then I want to delete on :arg1
     */
    public function iWantToDeleteOn($uri)
    {
        $this->response = $this->client->delete($uri . $this->deleteId);
    }


}

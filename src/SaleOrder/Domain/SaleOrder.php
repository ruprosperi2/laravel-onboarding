<?php

namespace Src\SaleOrder\Domain;

use Shared\Domain\ValueObject\Client;
use Shared\Domain\ValueObject\PaymentTerm;
use Shared\Domain\ValueObject\CreationDate;
use Shared\Domain\ValueObject\CreatedBy;
use Shared\Domain\ValueObject\State;
use Shared\Domain\ValueObject\Observation;
use Shared\Domain\ValueObject\Items;

final class SaleOrder
{
    private $client;
    private $paymentTerm;
    private $creationDate;
    private $createdBy;
    private $state;
    private $observation;
    private $items;

    public function __construct(
        Client $client,
        PaymentTerm $paymentTerm,
        CreationDate $creationDate,
        CreatedBy $createdBy,
        State $state,
        Observation $observation,
        Items $items
    )
    {
        $this->client = $client;
        $this->paymentTerm = $paymentTerm;
        $this->creationDate = $creationDate;
        $this->createdBy = $createdBy;
        $this->state = $state;
        $this->observation = $observation;
        $this->items = $items;
    }

    public function client(): Client
    {
        return $this->client;
    }

    public function paymentTerm(): PaymentTerm
    {
        return $this->paymentTerm;
    }

    public function creationDate(): CreationDate
    {
        return $this->creationDate;
    }

    public function createdBy(): CreatedBy
    {
        return $this->createdBy;
    }

    public function state(): State
    {
        return $this->state;
    }

    public function observation(): Observation
    {
        return $this->observation;
    }

    public function items(): Items
    {
        return $this->items;
    }

    public static function create(
        Client $client,
        PaymentTerm $paymentTerm,
        CreationDate $creationDate,
        CreatedBy $createdBy,
        State $state,
        Observation $observation,
        Items $items
    ): SaleOrder
    {
        $saleOrder = new self($client, $paymentTerm, $creationDate, $createdBy, $state, $observation, $items);

        return $saleOrder;
    }
}
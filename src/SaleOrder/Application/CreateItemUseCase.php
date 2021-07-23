<?php 

namespace Src\SaleOrder\Application;

use Src\SaleOrder\Domain\Contracts\SaleOrderRepositoryContract;
use Src\SaleOrder\Domain\Item;
use Src\SaleOrder\Domain\ValueObjects\SaleOrderId;
use Src\SaleOrder\Domain\ValueObjects\ItemName;
use Src\SaleOrder\Domain\ValueObjects\ItemAmount;
use Src\SaleOrder\Domain\ValueObjects\ItemPrice;
use Src\SaleOrder\Domain\ValueObjects\ItemSubTotal;

final class CreateItemUseCase
{
    private $repository;
    private $saleOrderId;

    public function __construct(SaleOrderRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $itemName,
        int $itemAmount,
        float $itemPrice,
        float $itemSubTotal
    ): void
    {
        $name = new ItemName($itemName);
        $amount = new ItemAmount($itemAmount);
        $price = new ItemPrice($itemPrice);
        $subTotal = new ItemSubTotal($itemSubTotal);
        $this->saleOrderId = new SaleOrderId(1);

        $item = Item::create($name, $amount, $price, $subTotal, $this->saleOrderId);

        $this->repository->saveItem($item);
    }
}
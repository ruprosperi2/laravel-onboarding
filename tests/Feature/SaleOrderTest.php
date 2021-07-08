<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\SaleOrder;
use App\Models\OrderItem;
use Tests\TestCase;

class SaleOrderTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_sale_order_without_items()
    {
        $sale_order = SaleOrder::factory()->create();
        $sale_order_id = $sale_order::find($sale_order->id)->id;
        $this->assertSame(1, $sale_order_id);

        $itemsCount = OrderItem::count();
        $this->assertEquals(0, $itemsCount);
    }

    public function test_create_sale_order_with_items(){
        $sale_order = SaleOrder::factory()->create();
        $user = OrderItem::factory()->create([
            'sale_order_id' => $sale_order->id
        ]);
        $this->assertEquals($sale_order->id, $user->sale_order_id);
    }
}

<?php

namespace App\Jobs;

use App\DirectScale;
use App\Models\Advocate;
use App\Models\Order;
use App\Models\Storefront;
use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Lib\ShopifyAPI as API;
use Log;
use App\Models\Product;

class ProcessNewOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $orderId = 0;
    private $storefrontId = 0;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($orderId = 0, $storefrontId = 0)
    {
        $this->orderId = $orderId;
        $this->storefrontId = $storefrontId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $orderId = $this->orderId;
        $storefrontId = $this->storefrontId;

        $storefront = Storefront::find($storefrontId);

        $shopifyOrder = $storefront->getOrder($orderId);

        if($shopifyOrder) {
            $order = Order::findOrCreate($shopifyOrder, $storefront);

            $shopifyTransactions = $storefront->getOrderTransactions($orderId);

            if($shopifyTransactions) {
                foreach ($shopifyTransactions as $shopifyTransaction) {
                    $transaction = Transaction::findOrNew($shopifyTransaction);

                    $order->transactions()->save($transaction);
                }
            }


        }
    }
}

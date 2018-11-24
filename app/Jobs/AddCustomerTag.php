<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Redis;

use App\Models\Storefront;

class AddCustomerTag implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $customerId;
    private $storefrontId;
    private $tag;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($storefrontId = 0, $customerId = 0, $tag = '')
    {
        $this->customerId = $customerId;
        $this->storefrontId = $storefrontId;
        $this->tag = $tag;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Redis::throttle('AddCustomerTag')->allow(50)->every(10)->then(function () {
            //Get storefront
            $storefront = Storefront::find($this->storefrontId);
            if($storefront){
                $shopify = $storefront->getPHPShopifyConnection();
                $customer = $shopify->Customer($this->customerId)->get();

                if($customer) {
                    info("customer", $customer);

                    $tags = $customer['tags'];

                    $result = $customer->put([
                        'tags' => $tags . ", " . $tag
                    ]);

                    return $result;
                }
            }

            return false;
        });
    }
}

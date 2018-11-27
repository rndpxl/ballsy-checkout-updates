<?php

namespace App\Jobs;

use App\Models\Storefront;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Redis;

class AddCustomerPhone implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $customerId;
    private $storefrontId;
    private $phone;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($storefrontId = 0, $customerId = 0, $phone = '')
    {
        $this->customerId = $customerId;
        $this->storefrontId = $storefrontId;
        $this->phone = $phone;
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

                    $result = $shopify->Customer($this->customerId)->put([
                        'phone' => $this->phone
                    ]);

                    return $result;
                }
            }

            return false;
        });
    }
}

<?php

namespace App\Console\Commands\Shopify;

use App\Jobs\ProcessNewOrder;
use App\Models\Order;
use App\Models\Storefront;
use App\Models\Transaction;
use Illuminate\Console\Command;
use App\Lib\ShopifyAPI as API;
use Log;

class DownloadOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shopify:download_orders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download all shopify orders';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Downloading Orders');

        $storefrontId = 1;

        $storefront = Storefront::find($storefrontId);

        $sh = $storefront->getShopifyConnection();

        $perPage = 100;

        // Get Product Count
        try
        {
            $countCall = $sh->call([ 'URL' => '/orders/count.json' ]);
            $orderCount = $countCall->count;

        }
        catch(\Exception $e)
        {
            Log::error('Connection Error: ' . $e->getMessage());
            $this->error('Connection error: ' . $e->getMessage());
            return;
        }


        $bar = $this->output->createProgressBar($orderCount);

        try
        {
            $totalCalls = ceil($orderCount / $perPage);

            for($i = 1; $i <= $totalCalls; $i++)
            {
                $call = $sh->call(
                    [
                        'URL' => "/orders.json?limit=$perPage&page=$i",
                        'METHOD' => 'GET',
                    ]);


                if (isset($call->orders) && count($call->orders))
                {
                    foreach ($call->orders as $shopifyOrder)
                    {

                        ProcessNewOrder::dispatch($shopifyOrder->id, $storefrontId);

                        $bar->advance();
                    }
                }
            }

            $bar->finish();
        }
        catch (\Exception $e)
        {
            Log::error($e);
            $this->error('Loop error: ' . $e->getMessage());
            return;
        }

        $this->info('');
        $this->info('Done');

        return;
    }
}

<?php

namespace App\Console\Commands\Shopify;

use Illuminate\Console\Command;
use App\Lib\ShopifyAPI as API;

class ClearWebhooks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shopify:clear_webhooks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all webhooks associated with this app';

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
        $this->info('Deleting webhooks');

        // Get webhooks and verify that each are in place
        $sh = new API([
            'API_KEY' => config('shopify.API_KEY'),
            'API_SECRET' => config('shopify.API_SECRET'),
            'SHOP_DOMAIN' => config('shopify.SHOP_DOMAIN'),
            'ACCESS_TOKEN' => config('shopify.ACCESS_TOKEN')
        ]);


        $existing = $sh->call([ 'URL' => 'webhooks.json' ]);

        $length = count($existing->webhooks);

        if($length > 0) {

            $bar = $this->output->createProgressBar($length);


            // DEV: TO DELETE ALL WEBHOOKS
            foreach ($existing->webhooks as $h) {
                $sh->call(['URL' => 'webhooks/' . $h->id . '.json', 'METHOD' => "DELETE"]);

                $bar->advance();
            }

            $bar->finish();

        }

        $this->info('');
        $this->info('Done');
    }
}

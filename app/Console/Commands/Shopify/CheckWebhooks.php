<?php

namespace App\Console\Commands\Shopify;

use Log;
use Illuminate\Console\Command;
use App\Lib\ShopifyAPI as API;

class CheckWebhooks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shopify:check_webhooks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verifies & Creates Shopify Webhooks';

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
        // Webhook config
        $webhooks = [

        ];

        // Get webhooks and verify that each are in place
        $sh = new API([
            'API_KEY' => config('shopify.API_KEY'),
            'API_SECRET' => config('shopify.API_SECRET'),
            'SHOP_DOMAIN' => config('shopify.SHOP_DOMAIN'),
            'ACCESS_TOKEN' => config('shopify.ACCESS_TOKEN')
        ]);


        $existing = $sh->call([ 'URL' => 'webhooks.json' ]);

        // Loop through all returned webhooks and knock out our pre-defined ones as they come in
        if (property_exists($existing, 'webhooks') && is_array($existing->webhooks) && count($existing->webhooks))
        {
            foreach($existing->webhooks as $h)
            {
                foreach($webhooks as $k => $wh)
                {
                    if ($wh['topic'] === $h->topic && $wh['address'] === $h->address)
                    {
                        unset($webhooks[$k]);
                        continue 2;
                    }
                }
            }
        }

        // Fix any leftover webhooks
        foreach($webhooks as $newHook)
        {
            $response = $sh->call([
                'URL' => 'webhooks.json',
                'METHOD' => 'POST',
                'DATA' => [ 'webhook' => $newHook ],
                'FAILONERROR' => FALSE
            ]);

            if (!property_exists($response, 'webhook'))
            {
                dd($response);
                Log::error('Could not create ' . $newHook['topic'] . ' webhook');
            }
        }

        $this->info('Done');

        return;
    }
}

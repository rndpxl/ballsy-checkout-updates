<?php
/**
 * Created by PhpStorm.
 * User: caleb
 * Date: 7/19/18
 * Time: 6:55 AM
 */

namespace App\Lib;


use PHPShopify\ShopifySDK;
use Log;

class Shopify
{
    public static function init($config = null){
        if($config == null) {
            $config = array(
                'ShopUrl' => config('shopify.SHOP_DOMAIN'),
                'AccessToken' => config('shopify.ACCESS_TOKEN')
            );
        }

        ShopifySDK::config($config);

        return new ShopifySDK;
    }

    public static function updateCustomer($customerId, $updates, ShopifySDK $shopify = null)
    {
        if($shopify == null){
            $shopify = Shopify::init();
        }

        try {
            $shopify->Customer($customerId)->put($updates);
        } catch (\Exception $e) {
            Log::error($e);

            return false;
        }

        return true;
    }

    public static function updateCustomerDefaultAddress($customerId, $address, ShopifySDK $shopify = null)
    {
        if($shopify == null){
            $shopify = Shopify::init();
        }

        try {
            $new_address = $shopify->Customer($customerId)->Address->post($address);

            $shopify->Customer($customerId)->Address($new_address['customer_address']['id'])->makeDefault();

        } catch (\Exception $e) {
            Log::error($e);

            return false;
        }

        return true;
    }
}
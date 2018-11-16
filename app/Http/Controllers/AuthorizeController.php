<?php

namespace App\Http\Controllers;

use App\Models\Storefront;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Input;
use PHPShopify\AuthHelper;
use PHPShopify\ShopifySDK;

class AuthorizeController extends Controller
{
    public function auth()
    {
        $store_url = Input::get('store');

        $config = array(
            'ShopUrl' => $store_url,
            'ApiKey' => config('shopify.API_KEY'),
            'SharedSecret' => config('shopify.API_SECRET'),
        );

        ShopifySDK::config($config);

        $scopes = [ 'write_orders', 'write_customers' ];

        AuthHelper::createAuthRequest($scopes, config('app.url') . '/code');


    }

    public function code(Request $r)
    {

        $store_url = Input::get('shop');

        $config = array(
            'ShopUrl' => $store_url,
            'ApiKey' => config('shopify.API_KEY'),
            'SharedSecret' => config('shopify.API_SECRET'),
        );

        ShopifySDK::config($config);

        $accessToken = AuthHelper::getAccessToken();


        $storefront = Storefront::firstOrNew([
            'shop_domain' => $store_url
        ]);
        $storefront->access_token = $accessToken;

        $storefront->save();

        $r->session()->put('message', "Storefront saved!");

        return redirect('/');

    }
}

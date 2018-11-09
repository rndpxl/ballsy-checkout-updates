<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Lib\ShopifyAPI as API;
use Log;

class Storefront extends Model
{
    protected $table = 'storefronts';
    protected $primaryKey = 'id';

    protected $fillable = ['shop_domain'];

    public function orders(){
        return $this->hasMany(Order::class, 'storefront_id', 'id');
    }

    public function getShopifyConnection() {
        return new API([
            'API_KEY' => $this->api_key,
            'API_SECRET' => $this->api_secret,
            'SHOP_DOMAIN' => $this->shop_domain,
            'ACCESS_TOKEN' => $this->access_token
        ]);
    }

    //Orders

    public function getOrder($orderId){
        $sh = $this->getShopifyConnection();

        try {

            $data = $sh->call(['URL' => 'orders/' . $orderId . '.json']);

            if (!property_exists($data, 'order')) {
                Log::error('Order: No order with ID ' . $orderId);
                return false;
            }

            return $data->order;
        } catch (\Exception $e) {
            Log::error($e);

            return false;
        }
    }

    public function getOrderTransactions($orderId){
        $sh = $this->getShopifyConnection();

        try {

            $data = $sh->call(['URL' => 'orders/' . $orderId . '/transactions.json']);

            if (!property_exists($data, 'transactions')) {
                Log::error('Transactions: No order with ID ' . $orderId);
                return false;
            }

            return $data->transactions;
        } catch (\Exception $e) {
            Log::error($e);

            return false;
        }
    }
}

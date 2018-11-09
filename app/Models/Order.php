<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Storefront;
use Log;
use Newsletter;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $fillable = ['shopify_order_id'];

    public static function findOrCreate($shopifyOrder, Storefront $storefront) {
        $order = Order::firstOrNew(
            [
                'shopify_order_id' => $shopifyOrder->id
            ]);

        Log::debug("shopify_order_id: " . $order->shopify_order_id);

        $order->shopify_order = json_encode($shopifyOrder);
        $order->customer_email = $shopifyOrder->email;

        $storefront->orders()->save($order);

        return $order;
    }

    public function getShopifyOrderAttribute($val = '')
    {
        $decoded = @json_decode($val);
        if (json_last_error() === JSON_ERROR_NONE)
        {
            return $decoded;
        }

        return $val;
    }

    public function transactions(){
        return $this->hasMany(Transaction::class, 'order_id', 'id');
    }

    public function storefront(){
        return $this->belongsTo(Storefront::class,'storefront_id', 'id');
    }

}

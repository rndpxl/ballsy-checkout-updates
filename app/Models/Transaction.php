<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Log;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $primaryKey = 'id';
    protected $fillable = ['shopify_transaction', 'gift_card_id', 'amount', 'order_id', 'shopify_transaction_id'];

    public function getShopifyTransactionAttribute($val = '')
    {
        $decoded = @json_decode($val);
        if (json_last_error() === JSON_ERROR_NONE)
        {
            return $decoded;
        }

        return $val;
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public static function findOrNew($shopifyTransaction) {
        Log::debug("transaction_id: " . $shopifyTransaction->id);

        $transaction = Transaction::firstOrNew(
            [
                'shopify_transaction_id' => $shopifyTransaction->id
            ]);

        Log::debug("shopify_transaction_id: " . $transaction->shopify_transaction_id);

        $transaction->shopify_transaction = json_encode($shopifyTransaction);

        if(property_exists($shopifyTransaction, 'receipt') && property_exists($shopifyTransaction->receipt, 'gift_card_id')){
            $transaction->gift_card_id = $shopifyTransaction->receipt->gift_card_id;
        }
        $transaction->amount = $shopifyTransaction->amount * 100;

        return $transaction;
    }
}

<?php

namespace App\Http\Controllers;

use App\Jobs\AddCustomerPhone;
use App\Jobs\AddCustomerTag;
use App\Jobs\UpdateCustomer;
use App\Models\Storefront;
use Illuminate\Http\Request;

use Log;

class CustomerController extends Controller
{
    public function signup(Request $r)
    {
        if(!$r->has('store') || Storefront::where('shop_domain', $r->input('store'))->first() == null){
            return response()
                ->json([ 'status' => FALSE, 'message' => 'Invalid storefront installation' ])
                ->withCallback($r->input('callback'));
        }

        $storefront = Storefront::where('shop_domain', $r->input('store'))->first();

        $customerData = [];
        $prefix = '';
        if ($r->has('customer'))
        {
            $prefix = 'customer.';
        }
        $customerData['email'] = $r->input($prefix . 'email');
//        $customerData['first_name'] = $r->input($prefix . 'first_name');
//        $customerData['last_name'] = $r->input($prefix . 'last_name');
        $customerData['password'] = $r->input($prefix . 'password');
        $customerData['password_confirmation'] = $r->input($prefix . 'password');
        $customerData['send_email_welcome'] = FALSE;
        if (!filter_var($customerData['email'], FILTER_VALIDATE_EMAIL))
        {
            return response()
                ->json([ 'status' => FALSE, 'message' => 'Please provide a valid email address.' ])
                ->withCallback($r->input('callback'));
        }
        if (!$customerData['password'])
        {
            return response()
                ->json([ 'status' => FALSE, 'message' => 'Please provide a password.' ])
                ->withCallback($r->input('callback'));
        }
        // Default
        $error = 'An unknown error has occurred, please try again.';
        // Send Info
        $api = $storefront->getShopifyConnection();
        $method = 'POST';
        $url = '/customers.json';
        $data = [ 'customer' => $customerData ];

        try
        {
            $customer = $api->call([
                'URL' => $url,
                'METHOD' => $method,
                'DATA' => $data,
                'ALLDATA' => TRUE,
                'FAILONERROR' => FALSE
            ]);
        }
        catch (\Exception $e)
        {
            Log::error($e->getMessage());
            return response()
                ->json([ 'status' => FALSE, 'message' => $error ])
                ->withCallback($r->input('callback'));
        }

        if (!$customer || (!property_exists($customer, 'customer') && !property_exists($customer, 'customer_invite')))
        {
            if (property_exists($customer, 'errors'))
            {
                $error = 'Could not create Account (';
                foreach((array) $customer->errors as $field => $reason)
                {
                    $error .= ucfirst($field) . ' ' . array_shift($reason) . ', ';
                }
                $error = trim($error, ', ') . ').';
            }
            return response()
                ->json([ 'status' => FALSE, 'message' => $error ])
                ->withCallback($r->input('callback'));
        }

        return response()
            ->json([ 'status' => TRUE ]);
    }

    public function sendAccountActivation(Request $r){
        if(!$r->has('store') || Storefront::where('shop_domain', $r->input('store'))->first() == null){
            return response()
                ->json([ 'status' => FALSE, 'message' => 'Invalid storefront installation' ])
                ->withCallback($r->input('callback'));
        }

        $storefront = Storefront::where('shop_domain', $r->input('store'))->first();


        $prefix = '';
        if ($r->has('customer'))
        {
            $prefix = 'customer.';
        }

        $customerId = $r->input($prefix . 'id');

        $method = 'POST';
        $url = '/customers/' . $customerId . '/send_invite.json';
        $data = ['customer_invite' => ''];
        $api = $storefront->getShopifyConnection();

        // Default
        $error = 'An unknown error has occurred, please try again.';
        try
        {
            $customerInvite = $api->call([
                'URL' => $url,
                'METHOD' => $method,
                'DATA' => $data,
                'ALLDATA' => TRUE,
                'FAILONERROR' => FALSE
            ]);
        }
        catch (\Exception $e)
        {
            Log::error($e->getMessage());
            return response()
                ->json([ 'status' => FALSE, 'message' => $error ])
                ->withCallback($r->input('callback'));
        }

        if (!property_exists($customerInvite, 'customer_invite'))
        {
            if (property_exists($customerInvite, 'errors'))
            {
                $error = 'Could not create Account (';
                foreach((array) $customerInvite->errors as $field => $reason)
                {
                    $error .= ucfirst($field) . ' ' . array_shift($reason) . ', ';
                }
                $error = trim($error, ', ') . ').';
            }
            return response()
                ->json([ 'status' => FALSE, 'message' => $error ])
                ->withCallback($r->input('callback'));
        }

        return response()
            ->json([ 'status' => TRUE ]);

    }

    public function addTag(Request $r, $customerId, $tag){
        $origin = request()->headers->get('origin');

        info($origin);

        $storefront = Storefront::first();

        AddCustomerTag::dispatch($storefront->id, $customerId, $tag);

        info($r->input());

        if($r->has('phone')){
            info('has phone number');

            $phone = $r->input('phone');

            AddCustomerPhone::dispatch($storefront->id, $customerId, $phone);
        }

        return response()->json([
            'success' => true
        ]);
    }
}

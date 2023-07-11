<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Braintree\Gateway;

class PaymentController extends Controller
{
    public function index() {
        $gateway = new Gateway([
            "environment" => env("BRAINTREE_ENVIRONMENT"),
            "merchantId" => env("BRAINTREE_MERCHANT_ID"),
            "publicKey" => env("BRAINTREE_PUBLIC_KEY"),
            "privateKey" => env("BRAINTREE_PRIVATE_KEY"),
        ]);

        $token = $gateway->ClientToken()->generate();
        return view('admin.sponsor.index', compact("token"));
    }

    public function checkout(Request $request) {
        $amount = $request->amount;
        $payment_method_nonce = $request->payment_method_nonce;

        $gateway = new Gateway([
            "environment" => env("BRAINTREE_ENVIRONMENT"),
            "merchantId" => env("BRAINTREE_MERCHANT_ID"),
            "publicKey" => env("BRAINTREE_PUBLIC_KEY"),
            "privateKey" => env("BRAINTREE_PRIVATE_KEY"),
        ]);

        $result = $gateway->transaction()->sale([
            "amount" => $amount,
            "paymentMethodNonce" => $payment_method_nonce,
            "options" => [
                "submitForSettlement" => true,
            ]
        ]);

        if($result->success) {
            $transaction = $result->transaction;
            return back()->with("success_message", "Transaction successfull. The id is: " . $transaction->id);
        } else {
            $errorString = "";

            foreach($result->errors->deepAll() as $error) {
                $errorString .= "Error: " . $error->code . ": " . $error->message . "\n";
            }

            return back()->withErrors($result->message);
        }
    }
}

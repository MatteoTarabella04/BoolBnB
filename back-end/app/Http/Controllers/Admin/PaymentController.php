<?php

namespace App\Http\Controllers\Admin;

use App\Models\SponsorizationPlan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Braintree\Gateway;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index(Apartment $apartment, SponsorizationPlan $sponsorization_plan)
    {
        $gateway = new Gateway([
            "environment" => env("BRAINTREE_ENVIRONMENT"),
            "merchantId" => env("BRAINTREE_MERCHANT_ID"),
            "publicKey" => env("BRAINTREE_PUBLIC_KEY"),
            "privateKey" => env("BRAINTREE_PRIVATE_KEY"),
        ]);

        $token = $gateway->ClientToken()->generate();
        return view('admin.sponsor.index', compact("token", "apartment", "sponsorization_plan"));
    }

    public function checkout(Request $request, Apartment $apartment, SponsorizationPlan $sponsorization_plan)
    {
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

        if ($result->success) {
            $lastSponsorization = DB::table("apartment_sponsorization_plan")->where("apartment_id", $apartment->id)->orderByDesc('expiry_date')->first();
            $lastExpiry = null;

            if($lastSponsorization) {
                $lastExpiry = $lastSponsorization->expiry_date;
            }

            $now = Carbon::now()->format("Y-m-d H:i:s");
            
            if($lastExpiry && $lastExpiry > $now) {
                $formattedExpiry = Carbon::createFromFormat("Y-m-d H:i:s", $lastExpiry);
                $expiry = $formattedExpiry->addHours($sponsorization_plan->duration)->format("Y-m-d H:i:s");
                $apartment->sponsorization_plans()->attach($sponsorization_plan, [
                    "starting_date" => $lastExpiry, 
                    "expiry_date" => $expiry
                ]);
            } else {
                $expiry = Carbon::now()->addHours($sponsorization_plan->duration)->format("Y-m-d H:i:s");
                $apartment->sponsorization_plans()->attach($sponsorization_plan, [
                    "starting_date" => $now, 
                    "expiry_date" => $expiry
                ]);
            }

            $transaction = $result->transaction;

            return to_route('admin.apartments.show', $apartment)->with("success_message", "Transazione avvenuta con successo. L'ID è: " . $transaction->id);
        } else {
            $errorString = "";

            foreach($result->errors->deepAll() as $error) {
                $errorString .= "Errore: " . $error->code . ": " . $error->message . "\n";
            }

            return back()->withErrors($result->message);
        }
    }
}
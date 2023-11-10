<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Omnipay\Omnipay;

class PaymentController extends Controller
{
    private $gateway;

    public function __construct()
    {
        $this->gateway = Omnipay::create("PayPal_Rest");
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true);
    }

    public function pay(Request $request)
{
    try {
        $response = $this->gateway->purchase([
            'amount' => $request->amount,
            'returnUrl' => url('success'),
            'cancelUrl' => url('error'),
        ])->send();

        if ($response->isRedirect()) {
            // Return the redirect URL to the Angular frontend
            return response()->json(['redirect_url' => $response->getRedirectUrl()]);
        } else {
            return response()->json(['error' => $response->getMessage()]);
        }
    } catch (\Throwable $th) {
        return response()->json(['error' => $th->getMessage()]);
    }
}


    public function success(Request $request)
    {
        if ($request->input('paymentId') && $request->input('buyerId')) {
            $transaction = $this->gateway->completePurchase([
                'buyer_id' => $request->input('buyerId'),
                'transactionReference' => $request->input('paymentId'),
            ]);

            $response = $transaction->send();

            if ($response->isSuccessful()) {
                $arr = $response->getData();
                $payment = new Payment();
                $payment->payment_id = $arr['id'];
                $payment->buyer_id = $arr['buyer']['buyer_info']['buyer_id'];
                $payment->buyer_email = $arr['buyer']['buyer_info']['buyer_email'];
                $payment->amount = $arr['transaction'][0]['amount']['total'];
                $payment->payment_status = $arr['state'];

                $payment->save();

                return response()->json(['message' => 'Payment successful']);
            } else {
                return $response->getMessage();
            }
        } else {
            return response()->json(['message' => 'Payment is declined']);
        }
    }

    public function error()
    {
        return response()->json(['message' => 'User declined the payment']);
    }
}

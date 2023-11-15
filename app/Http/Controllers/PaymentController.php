<?php

namespace App\Http\Controllers;

// use App\Models\Payment;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Omnipay\Omnipay;
// use Stripe\Checkout\Session;
// use Stripe\Stripe;
// use Stripe\StripeClient;


use Session;
use Stripe;
use Stripe\Stripe as StripeStripe;
use App\Models\Order; // Import the Order model

class PaymentController extends Controller
{
    public function stripe($id)
    {
        $order = Order::find($id);
        return view('stripe',['data'=> $order]);
    }

    public function stripePost(Request $request)
    {
        // dd($request);
        // Fetch the order from the database using the order ID
        $order = Order::find($request->id);
        // dd($order);

        if (!$order) {
            return back()->with('error', 'Order not found.');
        }

        // Get the total price from the order
        $totalPrice = $order->totalprice;

        // Set up the Stripe API key
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        try {
            // Charge the customer using the fetched total price
            $charge=Stripe\Charge::create([
                'amount' => $totalPrice * 100, // Convert total price to cents
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => 'Payment for order ' . $order->id,
            ]);

            $balanceTransactionId = $charge->balance_transaction;
            $balanceTransaction = Stripe\BalanceTransaction::retrieve($balanceTransactionId);
    
            // Log details about the balance transaction
            \Log::info('Balance Transaction Details:', $balanceTransaction->toArray());
    
            // Payment successful
            Session::flash('success', 'Payment has been successfully');
        } catch (Stripe\Exception\CardException $e) {
            // Handle card errors
            Session::flash('error', $e->getError()->message);
        } catch (Stripe\Exception\RateLimitException $e) {
            // Handle rate limit errors
            Session::flash('error', 'Rate limit exceeded. Please try again later.');
        } catch (Stripe\Exception\InvalidRequestException $e) {
            // Handle invalid request errors
            Session::flash('error', $e->getError()->message);
        } catch (Stripe\Exception\AuthenticationException $e) {
            // Handle authentication errors
            Session::flash('error', 'Authentication failed. Please check your Stripe API key.');
        } catch (Stripe\Exception\ApiConnectionException $e) {
            // Handle API connection errors
            Session::flash('error', 'Unable to connect to the Stripe API. Please try again later.');
        } catch (Stripe\Exception\Base $e) {
            // Handle other Stripe exceptions
            Session::flash('error', 'An error occurred while processing your payment.');
        }

        $order->update(['payment'=>'1']);
// dd($order);
        return redirect('http://localhost:4200/orders');
    }


    // // forth try

    // public function createPaymentIntent()
    // {
    //     $stripe = new StripeClient(config('services.stripe.secret'));

    //     $paymentIntent = $stripe->paymentIntents->create([
    //         'amount'   => 1099,
    //         'currency' => 'usd',
    //     ]);

    //     return response()->json(['clientSecret' => $paymentIntent->client_secret]);
    // }

    // //third try link in back end

    // public function createSubscriptionProduct()
    // {
    //     $stripe = new StripeClient(config('services.stripe.secret'));

    //     // Create product
    //     $product = $stripe->products->create([
    //         'name' => 'Starter Subscription',
    //         'description' => '$12/Month subscription',
    //     ]);

    //     echo "Success! Here is your starter subscription product id: " . $product->id . "\n";

    //     // Create price
    //     $price = $stripe->prices->create([
    //         'unit_amount' => 1200,
    //         'currency' => 'usd',
    //         'recurring' => ['interval' => 'month'],
    //         'product' => $product->id,
    //     ]);

    //     echo "Success! Here is your starter subscription price id: " . $price->id . "\n";
    // }

    //  // second try
    // private $stripeSecretKey = 'sk_test_51OAJmQIjYA1iuKSAYbGwvYX1eWgHH0nbJaHqeq8s9nFpEfNTA1iu0SjpLISNTU7TGBqiD11Jt6M9zGsHu3rfcjrD005tMFIUac';
    // private $port = 8000;

    // public function createCheckoutSession(Request $request)
    // {
    //     $domain = "http://localhost:{$this->port}/api";

    //     try {
    //         // Set your Stripe API key
    //         Stripe::setApiKey($this->stripeSecretKey);

    //         // Get amount
    //         $amount = $request->input('data.amount', 1000);

    //         // Create a Stripe session
    //         $session = Session::create([
    //             'payment_method_types' => ['card'],
    //             'line_items' => [
    //                 [
    //                     'price_data' => [
    //                         'currency' => 'usd',
    //                         'product_data' => [
    //                             'name' => 'Test payment',
    //                         ],
    //                         'unit_amount' => $amount,
    //                     ],
    //                     'quantity' => 1,
    //                 ],
    //             ],
    //             'mode' => 'payment',
    //             'success_url' => "{$domain}/stripe-successful-payment?hash=hash",
    //             'cancel_url' => "{$domain}/stripe-canceled-payment?hash=hash",
    //             'expand' => ['payment_intent'],
    //         ]);

    //         return response()->json($session);
    //     } catch (\Exception $e) {
    //         // Handle Stripe errors
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }

//  //first try    
//     private $gateway;

//     public function __construct()
//     {
//         $this->gateway = Omnipay::create("PayPal_Rest");
//         $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
//         $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
//         $this->gateway->setTestMode(true);
//     }

//     public function pay(Request $request)
// {
//     try {
//         $response = $this->gateway->purchase([
//             'amount' => $request->amount,
//             'returnUrl' => url('success'),
//             'cancelUrl' => url('error'),
//         ])->send();

//         if ($response->isRedirect()) {
//             // Return the redirect URL to the Angular frontend
//             return response()->json(['redirect_url' => $response->getRedirectUrl()]);
//         } else {
//             return response()->json(['error' => $response->getMessage()]);
//         }
//     } catch (\Throwable $th) {
//         return response()->json(['error' => $th->getMessage()]);
//     }
// }


//     public function success(Request $request)
//     {
//         if ($request->input('paymentId') && $request->input('buyerId')) {
//             $transaction = $this->gateway->completePurchase([
//                 'buyer_id' => $request->input('buyerId'),
//                 'transactionReference' => $request->input('paymentId'),
//             ]);

//             $response = $transaction->send();

//             if ($response->isSuccessful()) {
//                 $arr = $response->getData();
//                 $payment = new Payment();
//                 $payment->payment_id = $arr['id'];
//                 $payment->buyer_id = $arr['buyer']['buyer_info']['buyer_id'];
//                 $payment->buyer_email = $arr['buyer']['buyer_info']['buyer_email'];
//                 $payment->amount = $arr['transaction'][0]['amount']['total'];
//                 $payment->payment_status = $arr['state'];

//                 $payment->save();

//                 return response()->json(['message' => 'Payment successful']);
//             } else {
//                 return $response->getMessage();
//             }
//         } else {
//             return response()->json(['message' => 'Payment is declined']);
//         }
//     }

//     public function error()
//     {
//         return response()->json(['message' => 'User declined the payment']);
//     }
}

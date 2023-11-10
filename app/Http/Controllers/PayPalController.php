<?php

// app/Http/Controllers/PayPalController.php
// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use PayPal\Rest\ApiContext;
// use PayPal\Auth\OAuthTokenCredential;
// use PayPal\Api\Order;

// class PayPalController extends Controller
// {
//     private $apiContext;

//     public function __construct()
//     {
//         $this->apiContext = new ApiContext(
//             new OAuthTokenCredential(
//                 'AUq43hJFDLFrHd2WwGoq8WaHPDf0p37wjDTRN5STqSy4KLGLoGiUzQnPyEVivC6-9eKai0lZLk_UHIXJ',
//                 'EN922MhUpH4xt0Ngukx2Vq-GeoN3Kk6opaDKt2tTpH-VInOW6gTJlIGadZA_y8b0lLws0p8WyQEbsgmY'
//             )
//         );
//     }

//     public function createOrder(Request $request)
//     {
//         // Create a PayPal order on the server
//         $order = new Order();
//         $order->create($this->apiContext);
//         return response()->json(['id' => $order->getId()]);
//     }

//     public function executeOrder(Request $request)
//     {
//         // Execute a PayPal order on the server
//         $order = Order::get($request->input('orderID'), $this->apiContext);
//         $result = $order->capture([], $this->apiContext);
//         return response()->json($result->toArray());
//     }
// }

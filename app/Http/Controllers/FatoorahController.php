<?php

namespace App\Http\Controllers;

use App\Http\Services\FatoorahService;
use App\Models\User;
use Illuminate\Http\Request;

class FatoorahController extends Controller
{
    private $fatoorahService;
    public function __construct(FatoorahService $fatoorahService)
    {

        $this->fatoorahService = $fatoorahService;

    }

    public function checkout(Request $request, User $lawyer)
    {

        $data = [
            "CustomerName" => $lawyer->name,
            "Notificationoption" => "LNK",
            "Invoicevalue" => $lawyer->consultation_price,
            "CustomerEmail" => $lawyer->email,
            "CallBackUrl" => env('success_url'),
            "ErrorUrl" => env('error_url'),
            "Languagn" => 'en',
            "DisplayCurrencyIna" => 'KWD',
        ];

        return  $this->fatoorahService->sendPayment($data);
        
  }

    public function callback(Request $request)
    {
        $data = [
            'Key' => $request->paymentId,
            'KeyType' => 'paymentId',
        ];
        return $this->fatoorahService->getPaymentStatus($data);
        // $apiKey = 'your_token';

        // $response =$this->fatoorhServices->callAPI("https://apitest.myfatoorah.com/v2/getPaymentStatus", $apiKey, $postFields);
        // $response = json_decode($response);
        // if (!isset($response->Data->InvoiceId)) {
        //     return response()->json(["error" => 'error', 'status' => false], 404);
        // }

        // $InvoiceId = $response->Data->InvoiceId; // get your order by payment_id
        // if ($response->IsSuccess == true) {
        //     if ($response->Data->InvoiceStatus == "Paid") //||$response->Data->InvoiceStatus=='Pending'
        //     {
        //         if ($your_order_total_price == $response->Data->InvoiceValue) {

        //             /**
        //              *
        //              * The payment has been completed successfully. You can change the status of the order
        //              *
        //              */

        //         }
        //     }

        // }

        // return response()->json(["error" => 'error', 'status' => false], 404);
    }

}

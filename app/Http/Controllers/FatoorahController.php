<?php

namespace App\Http\Controllers;

use App\Http\Services\FatoorahService;
use App\Models\Document;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FatoorahController extends Controller
{
    private $fatoorahService;
    public function __construct(FatoorahService $fatoorahService)
    {

        $this->fatoorahService = $fatoorahService;

    }

//     public function checkout(Request $request, User $lawyer)
//     {

//         $data = [
//             "CustomerName" => $lawyer->name,
//             "Notificationoption" => "LNK",
//             "Invoicevalue" => $lawyer->lawyer->consultation_price,
//             "CustomerEmail" => $lawyer->email,
//             "CallBackUrl" => env('success_url'),
//             "ErrorUrl" => env('error_url'),
//             "Languagn" => 'en',
//             "DisplayCurrencyIna" => 'KWD',
//         ];

//         return  $this->fatoorahService->sendPayment($data);

//   }

public function callback(Request $request)
{
    $data = [
        'Key' => $request->paymentId,
        'KeyType' => 'paymentId',
    ];

    $response = $this->fatoorahService->getPaymentStatus($data);
    $InvoiceId = $response['Data']['InvoiceId'];

    $invoice = Invoice::where('invoiceId', $InvoiceId)->first();

    if ($invoice) {
        $document = Document::find($invoice->document_id);
        $user = User::find($document->sender_id );

        if ($user) {

            Auth::login($user);

            return redirect()->route('home_client');
        } else {
            return redirect()->route('home_client')->with('error', 'User not found');
        }
    } else {
        return redirect()->route('home_client')->with('error', 'Invoice not found');
    }
}


}

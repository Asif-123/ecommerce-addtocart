<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Globalpayments\Php\Api;
use Illuminate\Support\Facades\Auth;
use App\Models\cart\CartModel;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    protected $key;
    protected $secret;

    public function __construct()
    {
        $this->key = 'test_123';
        $this->secret = 'secret_123';
        $this->callbackUrl = "https://uat.mcsam.in/lion/sample-app/public/index.php/payment/success";
        //$this->callbackUrl = "http://127.0.0.1:8000/payment/success";
    }

    public function pay(Request $request)
    {
       
        if (Auth::check()) {
            $txnID = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
            $amount = (($request->amount) * 100);

            $customer = array(
                "name" => $request->name,
                "email" => $request->email,
                "phone" => $request->phone,
            );
            $pay = new Api($this->key, $this->secret);

            $result =  $pay->CreateOrder($amount, $txnID, $this->callbackUrl, $customer);
            $data = json_decode($result);
            
            if ($result) {
                $successUrl = base64_decode($data->url);
                return redirect($successUrl);
            }
        }
    }

    public function success(Request $request)
    {

        if (Auth::check()) {
            $fetchApi = new Api($this->key, $this->secret);
            $ApiResponse = $fetchApi->FetchOrder($request->order_id);
            if ($ApiResponse) {
                CartModel::where('user_id', Auth::id())->delete();
                // $status = array(
                //     'status' => '0',
                // );
                // DB::table('addtocart')->update($status);
                $data = json_decode($ApiResponse, true);
                return view('payment_success', ['response' => $data]);
            }
        }
    }
}

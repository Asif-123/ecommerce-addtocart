<?php

namespace Globalpayments\Php;

class Api
{

    protected $key;
    protected $secret;

    protected $endpoint = "https://gp-api.mcsam.in/api/";
    protected $version = "v1";

    protected $api = null;

    public function __construct($api_key, $api_secret)
    {
        $this->key = $api_key;
        $this->secret = $api_secret;

        $this->api = $this->endpoint . $this->version . '/';
    }

    public function CreateOrder($amount, $txnID, $callbackUrl, $customer, $bullingAddress = [], $shippingAddress = [])
    {
        //dd($callbackUrl);
        self::CustomerValidation($customer);

        return $this->POST($this->api . 'order/create', [
            'amount' => $amount,
            'callback_url' => $callbackUrl,
            'receipt_id' => $txnID,
            'cname' => $customer['name'],
            'email' => $customer['email'],
            'phone' => $customer['phone'],
        ]);
    }

    public function FetchOrder($id)
    {
        
        return $this->POST($this->api . 'order/fetch', [
            'key' => $this->key,
            'id' => $id
        ]);
    }

    public function createHash($params)
    {

        if (!is_array($params)) {
            throw new \Exception("Params must be an array");
        }

        $params['key'] = $this->key;

        ksort($params);

        $values = [];

        foreach ($params as $key => $value) {
            $values[] = $value;
        }

        $hash = hash('sha512', implode('|', $params)  . '|' . $this->secret);
        $params['hash'] = $hash;
        return $params;
    }

    private function POST($uri, $body)
    {
        $body = json_encode($this->createHash($body));

        // json_encode errors on invalid UTF-8
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception("Invalid UTF-8");
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $uri,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 200,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $body,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }

    private static function CustomerValidation($customer)
    {

        if (!isset($customer['name'])) {
            throw new \Exception("Customer name is required");
        }

        if (!isset($customer['email'])) {
            throw new \Exception("Customer email is required");
        }

        if (!isset($customer['phone'])) {
            throw new \Exception("Customer phone is required");
        }
    }
}

<?php
session_name("limelite_airtime");
session_start();

require_once __DIR__ . '/../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

    date_default_timezone_set('Africa/Nairobi');

    $config = require __DIR__ . '/../config/config.php';

    // Load from config/env
    $consumerKey = $config['DARAJA_CONSUMER_KEY'];
    $consumerSecret = $config['DARAJA_CONSUMER_SECRET'];
    $BusinessShortCode = $config['BUSINESS_SHORTCODE'];
    $Passkey = $config['DARAJA_PASSKEY'];
    $CallBackURL = $config['DARAJA_CALLBACK_URL'];

    // User inputs
    $PartyA = $_POST['phone'] ?? '';
    $Amount = $_POST['amount'] ?? 0;

    if (empty($PartyA) || empty($Amount)) {
        echo "<script>alert('Phone and amount are required');location.href='../index.php';</script>";
        exit;
    }

    $AccountReference = 'Limelite';
    $TransactionDesc = 'Limelite Tech Solutions';

    $Timestamp = date('YmdHis');
    $Password = base64_encode($BusinessShortCode . $Passkey . $Timestamp);

    // Get access token
    $access_token_url = 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
    $headers = ['Content-Type:application/json; charset=utf8'];

    $curl = curl_init($access_token_url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_USERPWD, $consumerKey . ':' . $consumerSecret);
    $result = curl_exec($curl);
    $response = json_decode($result);
    curl_close($curl);

    $access_token = $response->access_token ?? null;
    if (!$access_token) {
        echo "<script>alert('Failed to generate access token.');location.href='../index.php';</script>";
        exit;
    }

    // STK Push request
    $initiate_url = 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
    $stkheader = [
        'Content-Type:application/json',
        'Authorization:Bearer ' . $access_token
    ];

    $curl_post_data = [
        'BusinessShortCode' => $BusinessShortCode,
        'Password' => $Password,
        'Timestamp' => $Timestamp,
        'TransactionType' => 'CustomerPayBillOnline',
        'Amount' => $Amount,
        'PartyA' => $PartyA,
        'PartyB' => $BusinessShortCode,
        'PhoneNumber' => $PartyA,
        'CallBackURL' => $CallBackURL,
        'AccountReference' => $AccountReference,
        'TransactionDesc' => $TransactionDesc
    ];

    $curl = curl_init($initiate_url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $stkheader);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($curl_post_data));

    $curl_response = curl_exec($curl);
    curl_close($curl);

    $data = json_decode($curl_response);

    if (isset($data->ResponseCode) && $data->ResponseCode == "0") {
        $_SESSION["CHECKOUT"] = $data->CheckoutRequestID;
        echo "<script>alert('Wait for M-Pesa prompt, enter PIN and press OK!');location.href='../api/query.php';</script>";
    } else {
        $errorMessage = $data->errorMessage ?? 'Unknown error occurred';
        echo "<script>alert('Transaction failed: $errorMessage');location.href='../index.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request method');location.href='../index.php';</script>";
}
?>

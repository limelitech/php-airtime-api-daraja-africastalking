<?php
session_name("limelite_airtime");
session_start();

require_once __DIR__ . '/../config/config.php';

date_default_timezone_set('Africa/Nairobi');

// Load from .env via config.php
$config = require __DIR__ . '/../config/config.php';
$consumerKey = $config['DARAJA_CONSUMER_KEY'];
$consumerSecret = $config['DARAJA_CONSUMER_SECRET'];
$BusinessShortCode = $config['BUSINESS_SHORTCODE'];
$Passkey = $config['DARAJA_PASSKEY'];
$CallBackURL = $config['DARAJA_CALLBACK_URL'];

$AccountReference = 'Limelite';
$TransactionDesc = 'Limelite Tech Solutions';

$Timestamp = date('YmdHis');
$Password = base64_encode($BusinessShortCode . $Passkey . $Timestamp);

// Get CheckoutRequestID from session
$CheckoutRequestID = $_SESSION['CHECKOUT'] ?? null;

if (!$CheckoutRequestID) {
    echo "<script>alert('Session expired or missing checkout ID.');location.href='../index.php';</script>";
    exit;
}

// 1. Generate access token
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

// 2. Query STK push status
$stkQueryUrl = 'https://api.safaricom.co.ke/mpesa/stkpushquery/v1/query';
$stkheader = [
    'Content-Type:application/json',
    'Authorization:Bearer ' . $access_token
];

$curl_post_data = [
    'BusinessShortCode' => $BusinessShortCode,
    'Password' => $Password,
    'Timestamp' => $Timestamp,
    'CheckoutRequestID' => $CheckoutRequestID
];

$curl = curl_init($stkQueryUrl);
curl_setopt($curl, CURLOPT_HTTPHEADER, $stkheader);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($curl_post_data));

$stk_response = curl_exec($curl);
curl_close($curl);

$data = json_decode($stk_response);

if (isset($data->ResultCode)) {
    $msg = match ($data->ResultCode) {
        '0'    => 'Transaction successful.',
        '1032' => 'Transaction cancelled by user.',
        '1037' => 'Timeout in completing transaction.',
        '1'    => 'Insufficient balance.',
        default => 'Unknown response from Safaricom.',
    };
    echo "<script>alert('$msg');location.href='../index.php';</script>";
} else {
    echo "<script>alert('Invalid response from Safaricom.');location.href='../index.php';</script>";
}
?>

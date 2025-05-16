<?php
require_once __DIR__ . '/../vendor/africastalking/AfricasTalking.php';
require_once __DIR__ . '/../config/config.php';

use AfricasTalking\SDK\AfricasTalking;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $phone = $_POST['phone'];
    $amount = $_POST['amount'];
    $currency = 'KES';
    $date = date('Y-m-d H:i:s');
    $payersID = rand(10000000, 99999999);

    // Load environment variables
    $config = require __DIR__ . '/../config/config.php';
    $username = $config['AT_USERNAME'];
    $apiKey = $config['AT_API_KEY'];

    // Initialize SDK
    $AT = new AfricasTalking($username, $apiKey);
    $airtime = $AT->airtime();

    $recipients = [[
        "phoneNumber"  => $phone,
        "currencyCode" => $currency,
        "amount"       => $amount
    ]];

    try {
        $results = $airtime->send([
            "recipients" => $recipients
        ]);

        $response = json_decode(json_encode($results), true);

        if ($response['data']['errorMessage'] === 'None') {
            // Optional DB logging
            /*
            $conn = new mysqli($config['DB_HOST'], $config['DB_USER'], $config['DB_PASS'], $config['DB_NAME']);
            $stmt = $conn->prepare("INSERT INTO airtime (amount, currency, phone, payersID, status, created_at) VALUES (?, ?, ?, ?, ?, ?)");
            $status = 'success';
            $stmt->bind_param("ssssss", $amount, $currency, $phone, $payersID, $status, $date);
            $stmt->execute();
            */

            echo "<script>alert('Airtime sent successfully!');window.location.href='../index.php';</script>";
        } else {
            $msg = $response['data']['errorMessage'] ?? $response['data']['responses'][0]['errorMessage'] ?? 'Unknown Error';
            echo "<script>alert('Error: $msg');window.location.href='../index.php';</script>";
        }

    } catch (Exception $e) {
        echo "<script>alert('Exception: " . $e->getMessage() . "');window.location.href='../index.php';</script>";
    }
}
?>

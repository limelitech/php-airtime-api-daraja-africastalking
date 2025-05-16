<?php
header("Content-Type: application/json");

// Safaricom's confirmation success response
$response = [
    "ResultCode" => 0,
    "ResultDesc" => "Confirmation Received Successfully"
];

// Read M-Pesa response payload
$mpesaResponse = file_get_contents('php://input');

// Log to file
$logPath = __DIR__ . '/../logs/M_PESAConfirmationResponse.txt';
file_put_contents($logPath, $mpesaResponse . PHP_EOL, FILE_APPEND);

// Optionally decode and save to database
/*
$data = json_decode($mpesaResponse, true);
$config = require __DIR__ . '/../config/config.php';

$conn = new mysqli($config['DB_HOST'], $config['DB_USER'], $config['DB_PASS'], $config['DB_NAME']);
if (!$conn->connect_error && isset($data['Body']['stkCallback'])) {
    $callback = $data['Body']['stkCallback'];
    $amount = $callback['CallbackMetadata']['Item'][0]['Value'];
    $phone = $callback['CallbackMetadata']['Item'][4]['Value'];
    $transID = $callback['MpesaReceiptNumber'];

    $stmt = $conn->prepare("INSERT INTO mpesa_logs (transaction_id, phone, amount) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $transID, $phone, $amount);
    $stmt->execute();
}
*/

echo json_encode($response);
?>

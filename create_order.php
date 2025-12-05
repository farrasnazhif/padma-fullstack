<?php
session_start();
include "config/db.php";
include "config/midtrans.php";

use Midtrans\Snap;

$body = json_decode(file_get_contents('php://input'), true);

$name  = $body['name'];
$phone = $body['phone'];
$type  = $body['type'];

$cart = $_SESSION['cart'] ?? [];

$total = 0;
foreach ($cart as $c) $total += $c['qty'] * $c['price'];

// buat order pending
mysqli_query($conn,
"INSERT INTO orders(customer_name, phone, type, total_price, payment_method, payment_status)
 VALUES('$name', '$phone', '$type', '$total', 'midtrans', 'pending')");

$order_id = mysqli_insert_id($conn);

// buat ID Midtrans unik
$midtrans_order_id = "PADMA-$order_id-" . time();

mysqli_query($conn,
"UPDATE orders SET midtrans_order_id='$midtrans_order_id' WHERE id=$order_id");

// setup Snap
$params = [
    "transaction_details" => [
        "order_id" => $midtrans_order_id,
        "gross_amount" => $total
    ],
    "customer_details" => [
        "first_name" => $name,
        "phone"      => $phone
    ]
];

$token = Snap::getSnapToken($params);

echo json_encode([
    "order_id"   => $order_id,
    "snap_token" => $token,
    "client_key" => midtrans_client_key()
]);
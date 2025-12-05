<?php
require_once __DIR__ . '/../vendor/autoload.php';

// load secret keys
$env = include __DIR__ . '/.env.php';

// midtrans config
\Midtrans\Config::$serverKey = $env["MIDTRANS_SERVER_KEY"];
\Midtrans\Config::$clientKey = $env["MIDTRANS_CLIENT_KEY"];

\Midtrans\Config::$isProduction = false;
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

function midtrans_client_key() {
    global $env;
    return $env["MIDTRANS_CLIENT_KEY"];
}
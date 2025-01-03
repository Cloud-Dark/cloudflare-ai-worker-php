<?php

require 'vendor/autoload.php';  // Pastikan autoload Composer dimuat

use CloudDark\CloudflareAiWorker;  // Pastikan namespace yang sesuai

// Membuat instance dari CloudflareAiWorker untuk streaming
$worker = new CloudflareAiWorker(
    'https://api.cloudflare.com',   // URL Cloudflare API
    'XXX', // Account ID
    'XXX', // API Token
    '@cf/meta/llama-2-7b-chat-int8', // Model
    true // streaming aktif
);

// Menyiapkan prompt untuk streaming
$messages = 'where is new york?';

// Mengirim permintaan dan mendapatkan respons
$response = $worker->requestAiWorker($messages);

// Streaming langsung ditampilkan ke browser
?>

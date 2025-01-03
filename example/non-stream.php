<?php

require 'vendor/autoload.php';  // Pastikan autoload Composer dimuat

use CloudDark\CloudflareAiWorker;  // Pastikan namespace yang sesuai

// Membuat instance dari CloudflareAiWorker untuk non-streaming
$worker = new CloudflareAiWorker(
    'https://api.cloudflare.com',   // URL Cloudflare API
    'XXXX', // Account ID
    'XXXX', // API Token
    '@cf/meta/llama-3.1-70b-instruct', // Model
    false // non-streaming
);

// Menyiapkan pesan untuk dikirimkan
$messages = [
    [
        'role' => 'system',
        'content' => 'You are an AI assistant.'
    ],
    [
        'role' => 'user',
        'content' => 'Hello, AI!'
    ]
];

// Mengirim permintaan dan mendapatkan respons
$response = $worker->requestAiWorker($messages);

// Menampilkan respons jika tidak streaming
if (!$worker->getStream()) {
    print_r($response);
}
?>

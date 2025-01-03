<?php

// Pastikan autoloader Composer dimuat
require 'vendor/autoload.php';  // Tidak perlu path lengkap jika menggunakan Composer autoload

use CloudDark\CloudflareAiWorker;  // Pastikan namespace yang sesuai

// Membuat instance dari CloudflareAiWorker
$worker = new CloudflareAiWorker(
    'https://api.cloudflare.com',   // URL Cloudflare API
    'XXXXX', // Account ID
    'XXXXX', // API Token
    '@cf/meta/llama-3.1-70b-instruct' // Model
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
$response = json_encode($worker->requestAiWorker($messages));

// Menampilkan respons
print_r($response);

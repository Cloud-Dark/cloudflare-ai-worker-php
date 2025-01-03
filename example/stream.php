<?php

// Membuat instance dari CloudflareAiWorker
$worker = new CloudflareAiWorker(
    'https://api.cloudflare.com',   // URL Cloudflare API
    'XXXX', // Account ID
    'XXXX', // API Token
    '@cf/meta/llama-3.1-70b-instruct', // Model
    true //streaming aktif
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

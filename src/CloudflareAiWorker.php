<?php

namespace CloudDark;

class CloudflareAiWorker
{
    private $url;
    private $accountId; // Menyimpan account ID secara terpisah dari token
    private $token;
    private $model;

    // Konstruktor untuk mengatur URL API, token (API key), accountId, dan model
    public function __construct($url, $accountId, $token, $model)
    {
        $this->url = rtrim($url, '/'); // Pastikan URL tidak memiliki slash di akhir
        $this->accountId = $accountId; // Account ID disertakan terpisah
        $this->token = $token;
        $this->model = $model;
    }

    // Fungsi untuk mengatur URL
    public function setUrl($url)
    {
        $this->url = rtrim($url, '/');
    }

    // Fungsi untuk mengatur token
    public function setToken($token)
    {
        $this->token = $token;
    }

    // Fungsi untuk mengatur model
    public function setModel($model)
    {
        $this->model = $model;
    }

    // Fungsi untuk membuat permintaan cURL ke Cloudflare AI atau model lainnya
    public function requestAiWorker($messages)
    {
        $ch = curl_init();

        // Menyusun URL permintaan dengan model dan account_id
        $endpoint = "{$this->url}/client/v4/accounts/{$this->accountId}/ai/run/{$this->model}";

        // Menyiapkan data JSON untuk permintaan
        $data = json_encode([
            'messages' => $messages
        ]);

        // Mengatur opsi cURL
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->token,
            'Content-Type: application/json',
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        // Eksekusi permintaan
        $response = curl_exec($ch);

        // Cek jika terjadi error saat permintaan
        if (curl_errno($ch)) {
            throw new \Exception('Curl error: ' . curl_error($ch));
        }

        // Menutup koneksi cURL
        curl_close($ch);

        // Mengembalikan respon sebagai array
        return json_decode($response, true);
    }
}

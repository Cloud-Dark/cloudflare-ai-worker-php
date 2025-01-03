<?php

namespace CloudDark;

class CloudflareAiWorker
{
    private $url;
    private $accountId;
    private $token;
    private $model;
    private $stream;

    // Konstruktor untuk mengatur URL API, Account ID, token (API key), model, dan opsi streaming
    public function __construct($url, $accountId, $token, $model, $stream = false)
    {
        $this->url = rtrim($url, '/'); // Pastikan URL tidak memiliki slash di akhir
        $this->accountId = $accountId; // Menyimpan Account ID
        $this->token = $token;
        $this->model = $model;
        $this->stream = $stream; // Menyimpan opsi stream
    }

    // Fungsi untuk mengatur URL
    public function setUrl($url)
    {
        $this->url = rtrim($url, '/');
    }

    // Fungsi untuk mengatur Account ID
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;
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

    // Fungsi untuk mengatur opsi streaming
    public function setStream($stream)
    {
        $this->stream = $stream;
    }

    // Fungsi untuk membuat permintaan cURL dengan opsi streaming atau tidak
    public function requestAiWorker($messages)
    {
        $ch = curl_init();

        // Menyusun URL permintaan dengan Account ID dan model
        $endpoint = "{$this->url}/client/v4/accounts/{$this->accountId}/ai/run/{$this->model}";

        // Menyiapkan data JSON untuk permintaan
        $data = json_encode($this->stream
            ? ['prompt' => $messages, 'stream' => true] // Data untuk streaming
            : ['messages' => $messages] // Data untuk non-streaming
        );

        // Mengatur opsi cURL untuk streaming atau non-streaming
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, !$this->stream); // Jika tidak streaming, kembalikan hasil
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->token,
            'Content-Type: application/json',
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        if ($this->stream) {
            // Menambahkan konfigurasi untuk streaming
            curl_setopt($ch, CURLOPT_WRITEFUNCTION, function($ch, $data) {
                echo $data;  // Tampilkan data yang diterima secara langsung
                flush();     // Pastikan data langsung dikirimkan ke browser
                return strlen($data); // Kembali dengan panjang data yang diterima
            });
        }

        // Eksekusi permintaan
        $response = curl_exec($ch);

        // Cek jika terjadi error saat permintaan
        if (curl_errno($ch)) {
            throw new \Exception('Curl error: ' . curl_error($ch));
        }

        // Menutup koneksi cURL
        curl_close($ch);

        // Jika tidak streaming, kembalikan hasil sebagai array
        return !$this->stream ? json_decode($response, true) : null;
    }

    // Fungsi untuk mendapatkan status stream
    public function getStream()
    {
        return $this->stream;
    }
}

# Cloudflare AI Worker PHP Library

This is a simple PHP wrapper to interact with Cloudflare's AI Worker API. The wrapper allows you to send messages to the Cloudflare AI model and get responses in both **streaming** and **non-streaming** modes.

## Requirements

- PHP 7.4 or higher
- Composer

## Installation

To get started, you can install the package via Composer.

1. Clone the repository or initialize it in your project:

   ```bash
   composer require clouddark/cloudflare-ai-worker-php:dev-main
   ```

2. Upgrade dependencies using Composer:

   ```bash
   composer upgrade && composer update
   ```

   This will install the necessary dependencies and set up the autoloader.

## Usage

Once installed, you can use the `CloudflareAiWorker` class to send requests to the Cloudflare AI API.

### Example PHP Code

#### 1. **Non-Streaming (Standard Request)**

```php
<?php

// Ensure Composer autoloader is loaded
require 'vendor/autoload.php';  // No need for full path when using Composer autoload

use CloudDark\CloudflareAiWorker;  // Use the appropriate namespace

// Create an instance of CloudflareAiWorker for non-streaming
$worker = new CloudflareAiWorker(
    'https://api.cloudflare.com',   // Cloudflare API URL
    'XXXX', // Account ID
    'XXXX', // API Token
    '@cf/meta/llama-3.1-70b-instruct', // Model
    false // Non-streaming
);

// Prepare the message to send
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

// Send the request and get the response
$response = json_encode($worker->requestAiWorker($messages));

// Output the response
print_r($response);
?>
```

#### 2. **Streaming (Real-time Request)**

```php
<?php

// Ensure Composer autoloader is loaded
require 'vendor/autoload.php';  // No need for full path when using Composer autoload

use CloudDark\CloudflareAiWorker;  // Use the appropriate namespace

// Create an instance of CloudflareAiWorker for streaming
$worker = new CloudflareAiWorker(
    'https://api.cloudflare.com',   // Cloudflare API URL
    'XXXX', // Account ID
    'XXXX', // API Token
    '@cf/meta/llama-2-7b-chat-int8', // Model
    true // Streaming enabled
);

// Prepare the message to send (only prompt required for streaming)
$messages = 'where is new york?';

// Send the request and get the response
$response = $worker->requestAiWorker($messages);

// Streaming directly displayed to browser
?>
```

### Expected Response

The expected response from the Cloudflare AI Worker can vary based on the mode.

#### Non-Streaming Response:

The response for non-streaming will be a complete JSON object, similar to:

```json
{
    "result": {
        "response": "Hello! It's nice to meet you. I'm here to help answer any questions, provide information, or just chat if you'd like. How can I assist you today?"
    },
    "success": true,
    "errors": [],
    "messages": []
}
```

#### Streaming Response:

In the case of streaming, the data will be received and output in real-time. The response will be directly displayed as it is processed, which could look like:

```json
"Hello! It's nice to meet you. I'm here to help answer any questions..."
```

The output will be displayed as chunks of data in the browser as they are received from the API.

## Customization

You can customize the `CloudflareAiWorker` class by adjusting the URL, token, or model that you're using to interact with the Cloudflare AI API.

- **Set URL:** `setUrl('your-api-url')`
- **Set API Token:** `setToken('your-api-token')`
- **Set Model:** `setModel('your-model-id')`
- **Enable/Disable Streaming:** `setStream(true)` or `setStream(false)`

## License

This project is open-source and available under the [MIT License](LICENSE).

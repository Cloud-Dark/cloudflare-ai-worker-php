# Cloudflare AI Worker PHP Library

This is a simple PHP wrapper to interact with Cloudflare's AI Worker API. The wrapper allows you to send messages to the Cloudflare AI model and get responses.

## Requirements

- PHP 7.4 or higher
- Composer

## Installation

To get started, you can install the package via Composer.

1. Clone the repository or initialize it in your project:

   ```bash
   composer require clouddark/cloudflare-ai-worker-php:dev-main
   ```

2. Install dependencies using Composer:

   ```bash
   composer install
   ```

   This will install the necessary dependencies and set up the autoloader.

## Usage

Once installed, you can use the `CloudflareAiWorker` class to send requests to the Cloudflare AI API.

Here is an example of how to use the library:

### Example PHP Code

```php
<?php

// Ensure Composer autoloader is loaded
require 'vendor/autoload.php';  // No need for full path when using Composer autoload

use CloudDark\CloudflareAiWorker;  // Use the appropriate namespace

// Create an instance of CloudflareAiWorker
$worker = new CloudflareAiWorker(
    'https://api.cloudflare.com',   // Cloudflare API URL
    'XXXX', // Account ID
    'XXXX', // API Token
    '@cf/meta/llama-3.1-70b-instruct' // Model
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
```

### Expected Response

The expected response from the Cloudflare AI Worker will look like the following:

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

## Customization

You can customize the `CloudflareAiWorker` class by adjusting the URL, token, or model that you're using to interact with the Cloudflare AI API.

- **Set URL:** `setUrl('your-api-url')`
- **Set API Token:** `setToken('your-api-token')`
- **Set Model:** `setModel('your-model-id')`

## License

This project is open-source and available under the [MIT License](LICENSE).

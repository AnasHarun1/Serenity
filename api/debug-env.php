<?php

// Temporary debug endpoint - DELETE AFTER USE
header('Content-Type: application/json');

$key_env = getenv('GROQ_API_KEY');
$key_server = $_SERVER['GROQ_API_KEY'] ?? null;
$key_ENV = $_ENV['GROQ_API_KEY'] ?? null;

// Mask the key for security (show first 8 and last 4 chars)
function maskKey($key)
{
    if (empty($key))
        return '(EMPTY/NULL)';
    if (strlen($key) < 12)
        return '(TOO_SHORT: ' . strlen($key) . ' chars)';
    return substr($key, 0, 8) . '...' . substr($key, -4) . ' (' . strlen($key) . ' chars)';
}

// Also check via Laravel if possible
$laravel_config = null;
$laravel_env = null;
try {
    require __DIR__ . '/../vendor/autoload.php';
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    $kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();

    $laravel_config = config('services.groq.key');
    $laravel_env = env('GROQ_API_KEY');
} catch (\Exception $e) {
    $laravel_config = 'ERROR: ' . $e->getMessage();
}

echo json_encode([
    'groq_key_sources' => [
        'getenv()' => maskKey($key_env),
        '$_SERVER' => maskKey($key_server),
        '$_ENV' => maskKey($key_ENV),
        'config(services.groq.key)' => maskKey($laravel_config),
        'env(GROQ_API_KEY)' => maskKey($laravel_env),
    ],
    'all_env_keys_starting_with_GROQ' => array_filter(
        array_keys($_SERVER),
        fn($k) => str_contains(strtoupper($k), 'GROQ')
    ),
    'tip' => 'DELETE this file after debugging!'
], JSON_PRETTY_PRINT);

<?php

// Temporary debug endpoint - DELETE AFTER USE
header('Content-Type: application/json');

// Get ALL available env vars from different sources
$all_getenv = getenv();
$all_server_keys = array_keys($_SERVER);
$all_env_keys = array_keys($_ENV);

// Mask values for security
function maskVal($v)
{
    if (empty($v))
        return '(EMPTY)';
    $v = (string) $v;
    if (strlen($v) <= 6)
        return $v;
    return substr($v, 0, 4) . '...' . substr($v, -3) . ' (' . strlen($v) . 'c)';
}

// Filter for interesting env vars (not standard HTTP/server ones)
$interesting = [];
foreach ($all_getenv as $k => $v) {
    // Skip standard server vars
    if (in_array($k, ['PATH', 'SYSTEMROOT', 'COMSPEC', 'PATHEXT', 'WINDIR', 'TMP', 'TEMP', 'HOME']))
        continue;
    if (str_starts_with($k, 'HTTP_'))
        continue;
    if (str_starts_with($k, 'SERVER_'))
        continue;
    if (str_starts_with($k, 'REQUEST_'))
        continue;
    if (str_starts_with($k, 'REMOTE_'))
        continue;
    $interesting[$k] = maskVal($v);
}

echo json_encode([
    'interesting_env_vars' => $interesting,
    'total_getenv_count' => count($all_getenv),
    'total_server_count' => count($all_server_keys),
    'total_env_count' => count($all_env_keys),
    'groq_specific' => [
        'GROQ_API_KEY_getenv' => maskVal(getenv('GROQ_API_KEY')),
        'groq_api_key_lower' => maskVal(getenv('groq_api_key')),
    ],
    'tip' => 'DELETE this file after debugging!'
], JSON_PRETTY_PRINT);

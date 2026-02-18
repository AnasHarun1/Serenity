<?php

// Enable Error Reporting immediately
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// FIX: Set explicit APP_URL to prevent "Host is malformed" error
// Laravel Console tries to parse this URL during bootstrap.
// If it contains unexpanded variables like ${VERCEL_URL}, it crashes.
putenv('APP_URL=http://localhost');
$_ENV['APP_URL'] = 'http://localhost';

echo "<h1>System Diagnostic & Migration (Patched)</h1>";

try {
    echo "Checking environment...<br>";

    $vendorPath = __DIR__ . '/../vendor/autoload.php';
    if (!file_exists($vendorPath)) {
        throw new Exception("Vendor autoload not found at: $vendorPath");
    }
    require $vendorPath;
    echo "Vendor loaded.<br>";

    $bootstrapPath = __DIR__ . '/../bootstrap/app.php';
    if (!file_exists($bootstrapPath)) {
        throw new Exception("Bootstrap not found at: $bootstrapPath");
    }
    $app = require $bootstrapPath;
    echo "App required.<br>";

    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();
    echo "Kernel bootstrapped.<br>";

    // Test Database Connection
    echo "Testing Database Connection...<br>";
    try {
        \Illuminate\Support\Facades\DB::connection()->getPdo();
        echo "Database connection successful!<br>";
    } catch (\Exception $e) {
        throw new Exception("Database Connection Failed: " . $e->getMessage());
    }

    echo "Running migration (force)...<br>";
    Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
    echo "<pre>" . Illuminate\Support\Facades\Artisan::output() . "</pre>";

    echo "<h3>DONE.</h3>";

} catch (Throwable $e) {
    echo "<h2 style='color:red'>FATAL ERROR</h2>";
    echo "<pre>" . $e->getMessage() . "</pre>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}

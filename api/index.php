<?php
try {
    // Vercel read-only filesystem fix: Set early before Laravel boots!
    if (isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL'])) {
        $paths = ['/framework/views', '/framework/cache/data', '/logs', '/framework/sessions', '/bootstrap/cache'];
        foreach ($paths as $path) {
            if (!is_dir('/tmp/storage' . $path)) {
                @mkdir('/tmp/storage' . $path, 0777, true);
            }
        }
        $_SERVER['APP_PACKAGES_CACHE'] = '/tmp/storage/bootstrap/cache/packages.php';
        $_SERVER['APP_SERVICES_CACHE'] = '/tmp/storage/bootstrap/cache/services.php';

        // Neon.tech SNI Fix for Vercel
        foreach (['DB_URL', 'DATABASE_URL'] as $envKey) {
            $dbUrl = $_ENV[$envKey] ?? $_SERVER[$envKey] ?? getenv($envKey);
            if ($dbUrl && strpos($dbUrl, 'neon.tech') !== false && preg_match('/@(ep-[a-z0-9\-]+)\./', $dbUrl, $matches)) {
                if (strpos($dbUrl, 'options=endpoint') === false) {
                    $dbUrl .= (strpos($dbUrl, '?') !== false ? '&' : '?') . 'options=endpoint%3D' . $matches[1];
                    $_ENV[$envKey] = $_SERVER[$envKey] = $dbUrl;
                    putenv($envKey . '=' . $dbUrl);
                }
            }
        }
    }

    require __DIR__ . '/../public/index.php';
} catch (\Throwable $e) {
    echo "<h1>Real Error:</h1>";
    echo "<pre>";
    echo "MAIN EXCEPTION: " . $e->getMessage() . "\n";
    if ($e->getPrevious()) {
        echo "\n\nPREVIOUS EXCEPTION (THE REAL CAUSE!): " . $e->getPrevious()->getMessage() . "\n";
        echo $e->getPrevious()->getTraceAsString();
    } else {
        echo $e->getTraceAsString();
    }
    echo "</pre>";
}

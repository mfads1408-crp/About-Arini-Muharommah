<?php
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
                $endpoint = $matches[1];
                // Remove existing options=endpoint if it exists
                $dbUrl = preg_replace('/(\?|&)options=endpoint[^&]+/', '', $dbUrl);
                // Remove the username prefix if it was added previously
                $dbUrl = str_replace($endpoint . '%24', '', $dbUrl);
                $dbUrl = str_replace($endpoint . '$', '', $dbUrl);
                
                // Inject options=endpoint into sslmode to bypass Laravel's array options and go straight to PDO DSN
                if (strpos($dbUrl, 'sslmode=') !== false && strpos($dbUrl, ';options=endpoint') === false) {
                    $dbUrl = str_replace('sslmode=require', 'sslmode=require;options=endpoint=' . $endpoint, $dbUrl);
                    $dbUrl = str_replace('sslmode=prefer', 'sslmode=prefer;options=endpoint=' . $endpoint, $dbUrl);
                } else if (strpos($dbUrl, 'sslmode=') === false) {
                    $dbUrl .= (strpos($dbUrl, '?') !== false ? '&' : '?') . 'sslmode=require;options=endpoint=' . $endpoint;
                }
                
                $_ENV[$envKey] = $_SERVER[$envKey] = $dbUrl;
                putenv($envKey . '=' . $dbUrl);
            }
        }
    }

    require __DIR__ . '/../public/index.php';

<?php
try {
    require __DIR__ . '/../public/index.php';
} catch (\Throwable $e) {
    echo "<h1>Real Error:</h1>";
    echo "<pre>";
    echo $e->getMessage() . "\n";
    echo $e->getTraceAsString();
    echo "</pre>";
}

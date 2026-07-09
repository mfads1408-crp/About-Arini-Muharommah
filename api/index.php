<?php
try {
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

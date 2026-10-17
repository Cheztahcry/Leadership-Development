<?php
require_once __DIR__ . '/vendor/autoload.php';

if (class_exists('Handlers\StudentInfoHandler')) {
    echo "Autoloader working! Class found.";
} else {
    echo "Class still not found. Check composer.json path and file namespace.";
}
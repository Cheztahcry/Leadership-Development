<?php
spl_autoload_register(function ($class) {
    // Converts "Handlers\StudentInfoHandler" -> "Handlers/StudentInfoHandler.php"
    $file = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});

?>
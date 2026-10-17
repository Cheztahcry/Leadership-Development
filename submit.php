<?php
require_once __DIR__ . '/vendor/autoload.php';
date_default_timezone_set('Asia/Manila');
$logDir = __DIR__ . '/error_logs';
if (!is_dir($logDir)) {
    mkdir($logDir, 0755, true);
}
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', $logDir . '/submit.txt');


try {
    if (class_exists('Handlers\StudentInfoHandler')) {
    echo "Autoloader woring! Class found.";
    $handler = new \Handlers\StudentInfoHandler();
    echo $handler->info_insert($_POST);
    }
    else {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid or missing action']);
    }
}catch (PDOException $e) {
        error_log("Database: " . $e->getMessage());
        die("Something went wrong. Please check back later.");
}

?>
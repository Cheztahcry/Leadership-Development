<?php
namespace Handlers;
date_default_timezone_set('Asia/Manila');
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__DIR__, 2) . '/error_logs/student_info_handler.txt');
session_start();
use Services\StudentInfo;
class StudentInfoHandler{
    public function info_insert(){
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $lname  = trim($_POST['lname'] ?? '');
    $fname  = trim($_POST['fname'] ?? '');
    $gender = $_POST['gender'] ?? null;
    $network_leader_fname = trim($_POST['network_leader_fname'] ?? null);
    $network_leader_lname = trim( $_POST['network_leader_lname'] ?? null);
    $cell_leader_fname = trim($_POST['cell_leader_fname'] ?? null);
    $cell_leader_lname = trim($_POST['cell_leader_lname'] ?? null);
    $student = new StudentInfo();
    $user_id = $student->generate_user_id();

    $insert_info = [ 
        "first_name"   => $fname,
        "last_name"    => $lname,
        "gender"       => $gender,
        "netlead_fname" => $network_leader_fname,
        "netlead_lname" => $network_leader_lname,
        "celllead_fname" => $cell_leader_fname,
        "celllead_lname" => $cell_leader_lname,
        "uid" => $user_id
    ];
    try{
        $student = new StudentInfo();
        $student->insert_student_info($insert_info);
        header("Location: index.php");
        exit;
    }catch (PDOException $e) {
        error_log("Database: " . $e->getMessage());
        die("Something went wrong. Please check back later.");
    }
    
}
    }   
}

   
?>

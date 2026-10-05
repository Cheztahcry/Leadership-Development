<?php
$student = null;
$uid = trim(($_POST['uid'] ?? null));
echo $uid;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once __DIR__ . '/student_info_class.php';
    $student = new Studentinfo();
}   
?>

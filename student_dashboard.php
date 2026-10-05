<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once __DIR__ . '/students_info_class.php';
    $uid = trim(($_POST['uid'] ?? null));
    $student_info = new StudentInfo();
    $student = $student_info->show_studentinfo($uid);
    
}
else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/owner_info_style.css">
</head>
<body>
    <div class="student form">
        <div class="container">
            <div class="page-header">
                <nav class="page-nav">
                    <a class="nav-link" href="index.php">Home</a>
                </nav>
            </div>

            <h1>Student Dashboard</h1>
                <div class="acct-tab" id="acct-tab">
                    <div class="acct-tabs">
                        <label class="status-option acct-tab-button">
                            <input type="radio" name="acct-stat" id="acct-info-radio" value="Student Information" checked>
                            <span>Student Information</span>
                        </label>
                        <label class="status-option acct-tab-button">
                            <input type="radio" name="acct-stat" id="acct-tran-radio" value="LD Information">
                            <span>LD Information</span>
                        </label>
                    </div>
                </div>

                    

                    <div class="acct-panel" id="acct-info-content">
                        <div class="button-row">
                            <button type="button" id="edit" class="secondary-btn">Edit Information</button>
                            <button type="button" id="save" class="primary-btn">Save Information</button>
                        </div>
                        <div class="field-group">
                            <label>Full Name</label>
                            <div class="field-row">
                                <input type="text" name="lname" placeholder="Last Name" required value="<?= htmlspecialchars($student->last_name) ?>">
                                <input type="text" name="fname" placeholder="First Name" required value="<?= htmlspecialchars($student->first_name) ?>">
                            </div>
                        </div>
                        <div class="field-group">
                            <label>Gender</label>
                            <div class="field-row">
                                <input type="text" name="gender" placeholder="Gender" required value="<?= htmlspecialchars($student->gender) ?>">
                            </div>
                        </div>
                        <div class="field-group">
                            <label for="password">User ID</label>
                            <div class="field-row">
                                <label><?= htmlspecialchars($student->uid) ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="acct-panel" id="acct-tran-content">
                        <div class="transaction-summary">
                            <h2>Student Information</h2>
                        </div>
                        <div class="transaction-card">
                            <div class="transaction-card__header">
                                <span>Cell Leader</span>
                                <span>Network Leader</span>
                                <span>Current LD #</span>
                                <span>Status</span>
                            </div>
                        </div>
                    </div>
                    
                    
                    
                    
                
                


        </div>
    </div>
    

    <script src="js/student_dashboard.js" defer></script>
</body>
</html>
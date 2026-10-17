<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Information</title>
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
            <h1>Student Information</h1>
            <form action="submit.php" method="post" id="owner-enrollment" name="StudentInfo">
                <div class="field-group">
                    <label>Full Name</label>
                    <div class="field-row">
                        <input type="text" name="lname" placeholder="Last Name" required>
                        <input type="text" name="fname" placeholder="First Name" required>
                        </label>
                    </div>
                </div>
                <div class="field-group">
                    <label>Gender</label>
                    <div class="field-row">
                        <label>
                            <input type="radio" name="gender" value="Male"> Male
                        </label>
                        <label>
                            <input type="radio" name="gender" value="Female"> Female
                        </label>
                    </div>

                </div>
                <div class="field-group">
                    <label>Network Leader</label>
                    <div class="field-row">
                        <input type="text" name="network_leader_lname" placeholder="Last Name" required>
                        <input type="text" name="network_leader_fname" placeholder="First Name" required>
                        </label>
                    </div>
                </div>
                <div class="field-group">
                    <label>Cell Leader</label>
                    <div class="field-row">
                        <input type="text" name="cell_leader_lname" placeholder="Last Name" required>
                        <input type="text" name="cell_leader_fname" placeholder="First Name" required>
                        </label>
                    </div>
                </div>
                <div class="field-group">
                    <label>Current LD #</label>
                    <div class="field-row">
                        <label>
                            <input type="radio" name="ld" value="LD1"> LD # 1
                        </label>
                        <label>
                            <input type="radio" name="ld" value="LD2"> LD # 2
                        </label>
                        <label>
                            <input type="radio" name="ld" value="LD3"> LD # 3
                        </label>
                        <label>
                            <input type="radio" name="ld" value="LD4"> LD # 4
                        </label>
                        <input type="hidden" name="action" value="StudentInfo">
                    </div>

                </div>
                <div class="button-row">
                    <button type="submit" name="submit" id="submit">Next Section</button>
                    <button type="button" id="clear">Clear Fields</button>
                </div>

            </form>
        </div>
    </div>
    <script src="js/owner_info.js"></script>
    <script src="js/duplicate_handler.js" defer></script>

</body>
</html>
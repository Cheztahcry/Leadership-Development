<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/owner_info_style.css">
</head>
<body>
    <div class="student form">
        <div class="container">
            <div class="page-header">
                <nav class="page-nav">
                    <a class="nav-link" href="index.php">Home</a>
                    <a class="nav-link" href="login.php">Login</a>
                </nav>
            </div>
            <h1>LD Head Information</h1>
            <form action="ld_head_info_class.php" method="post" id="owner-enrollment">
                <div class="field-group">
                    <label>Full Name</label>
                    <div class="field-row">
                        <input type="text" name="lname" placeholder="Last Name" required>
                        <input type="text" name="fname" placeholder="First Name" required>
                    </div>
                </div>
                <div class="field-group">
                    <label for="username">Enter Valid Email</label>
                    <div class="field-row">
                        <input type="text" name="email" id="username" placeholder="Email">
                    </div>
                    <div name = "message"></div>
                </div>
                <div class="field-group">
                    <label for="password">Create Password</label>
                    <div class="field-row">
                        <input type="password" name="password" id="password" placeholder="Password">
                    </div>
                </div>
                <div class="field-group">
                    <label for="password">Confirm Password</label>
                    <div class="field-row">
                        <input type="password" name="confirm_password" id="confirm-password" placeholder="Password" required>
                    </div>
                </div>
                
                <div class="button-row">
                    <button type="submit" name="submit" id="submit">Create Account</button>
                    <button type="button" id="clear">Clear Fields</button>
                </div>
            </form>
        </div>
    </div>
    <script src="js/owner_info.js"></script>
    <script src="js/duplicate_handler.js" defer></script>

</body>
</html>
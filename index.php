<DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/index.css">
    
</head>
<body>
<header>
    <div class="logo_row">
        <img src="assets/img/logo_solwin.png" class="logo" alt="Solwin Logo">
        <a href="index.php" class="brand-title">SOLWIN</a>
    </div>
    <div class="header-links">
        <?php if($users_inst):?>
            <a href="owner_dashboard.php" class="user_greet">
                <?php if(!empty($user->picture)): ?>
                    <img src="assets/img/uploads/<?= htmlspecialchars($users_inst->picture) ?>" alt="Profile" class="user-avatar" style="width:30px;height:30px;border-radius:50%;object-fit:cover;">
                <?php else: ?>
                    <span class="user-icon" aria-hidden="true">👤</span>
                <?php endif; ?>
                <span>Hello, <?= htmlspecialchars($users_inst->first_name) ?>!</span>
            </a>
            
            <div class="action-group">
                <a href="student_info.php" class="signin-btn">Add a Student</a>
            </div>
            <div class="action-group">
                <a href="logout.php" class="signin-btn">LOG OUT</a>
            </div>
        <?php else:?>
            <div class="action-group">
                <a href="login.php" class="signin-btn">SIGN-IN</a>
                <a href="owner_info.php" class="signin-btn">SIGN-UP</a>
            </div>
        <?php endif;?>
    </div>
</header>
    <div class = "options">
        
        <div class="search-field">
            <span class="search-icon" aria-hidden="true"></span>
            <input type="text" name="search_bar" id="search_bar" class="search-input" placeholder="Search by Name, Cell & Network Leader">
        </div>
        <button type="button" class="option-btn search-btn" id= "search-button">Search</button>
        <button type="button" class="option-btn filter-btn">Filter</button>
        <div class="filter-group hidden">
            <div class="filter-header">
                <span>Sort &amp; filter</span>
            </div>
            <div class="filter-controls">
                <div class="filter-control">
                    <label for="sort_by" class="filter-label">Sort by</label>
                    <select name="sort_by" id="sort_by" class="filter-select">
                        <option value="block">LD Number</option>
                    </select>
                </div>
                <div class="filter-control">
                    <label for="sort_order" class="filter-label">Sort order</label>
                    <select name="sort_order" id="sort_order" class="filter-select">
                        <option value="asc">Ascending</option>
                        <option value="desc">Descending</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    

        
    <div class = "student-dashboard" id = "student-dashboard">
        <div class = "dashboard-container">
        
            <table>
            <thead>
            <tr>
                <th>Student ID.</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Gender</th>
                <th>Network Leader</th>
            </tr>
            </thead>
            <tbody>
                <?php if ($students && count($students) > 0): ?>
                <?php foreach ($students as $row): ?>           
                <tr>
                    <td><?= htmlspecialchars($row->uid) ?></td>
                    <td><?= htmlspecialchars($row->first_name) ?></td>
                    <td><?= htmlspecialchars($row->last_name) ?></td>
                    <td><?= htmlspecialchars($row->gender) ?></td>
                    <td><?= htmlspecialchars($row->netlead_fname . ' ' . $row->netlead_lname) ?></td>
                    <td class="action-cell">
                        <form action="student_dashboard.php" method="POST">
                        <button type="submit" name ="uid" class="action-btn inquire-btn" value = "<?= htmlspecialchars($row->uid) ?>">More Info</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 20px; color: #666;">
                            <strong>No students record are currently available.</strong><br>
                            Please try refreshing the page or check back later.
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
                </table>
        </div>
        
    </div>
    <div id = "search-results">
        
    </div>
        
</body>
 <footer>
        <p>© 2026 Solwin Church. All rights reserved.</p>
    </footer>
        <script src="js/index.js" defer></script>
        <script src="js/jquery.js" defer></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</body>
</html>
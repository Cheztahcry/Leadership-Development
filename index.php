<?php
require_once __DIR__ . '/index_handler.php';
include_once __DIR__ . '/students_info_class.php';
$index_handler = new Index();
$users_inst = $index_handler -> ini_index();
$users_id = $users_inst['id'];
$users_cokkies = $users_inst['cookie'];
$student_info = new StudentInfo();
$students = $student_info->show_students();


?>
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
        <?php if($user_id):?>
            
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
                        <button type="button" class="action-btn inquire-btn">More Info</button>
                        
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
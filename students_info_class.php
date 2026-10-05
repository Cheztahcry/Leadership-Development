<?php
    ob_start();
    require_once 'Database.php';
    class StudentInfo extends Database {
        public function __construct() {
        parent::__construct();
    }
        public function create_student_table(array $create_info){
            
            $this->create_table($this->query_config['tables']['students'], $create_info);
        }
        public function insert_student_info(array $insert_info){
            try {
            $this->pdo->beginTransaction();
            $stmtStudent = $this->pdo->prepare("
                INSERT INTO `{$this->query_config['tables']['students']}` (uid, first_name, last_name, gender, netlead_fname, netlead_lname)
                VALUES (:uid, :first_name, :last_name, :gender, :netlead_fname, :netlead_lname)
            ");
            $stmtStudent->execute([
                'uid' => $insert_info["uid"],
                'first_name' => $insert_info["first_name"],
                'last_name'  => $insert_info["last_name"],
                'gender'     => $insert_info["gender"],
                'netlead_fname' => $insert_info["netlead_fname"],
                'netlead_lname' => $insert_info["netlead_lname"],
            ]);
            $stmtAttendance = $this->pdo->prepare("
                INSERT INTO `{$this->query_config['tables']['students_dashboard']}` (uid, is_active, is_completer, is_baptism)
                VALUES (:uid, :is_active, :is_completer, :is_baptism)
            ");
            $stmtAttendance->execute([
                'uid'  => $insert_info["uid"],
                'is_active' => 1,
                'is_baptism' => 0,
                'is_completer' => 1
            ]);

            $this->pdo->commit();


        } catch (Exception $e) {
            $this->pdo->rollBack();
            echo "Error inserting records: " . $e->getMessage();
        }
        }
        public function show_studentinfo($uid) {
            $sql = "SELECT * FROM `{$this->query_config['tables']['students']}` WHERE uid = ? LIMIT 1";
            $stmt = $this->pdo->prepare($sql);          
            $stmt->execute([$uid]);
            $user = $stmt->fetch(PDO::FETCH_OBJ);
            return $user;
        }
        public function show_students() {
            $sql = "SELECT * FROM `{$this->query_config['tables']['students']}`";
            $stmt = $this->pdo->prepare($sql);          
            $stmt->execute();
            $user = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $user;
        }


        public function update_studentinfo(int $id, array $updates){
            if (empty($updates)) return false;
            $sets = [];
            $params = [];
            foreach ($updates as $col => $val) {
                $sets[] = "`$col` = :$col";
                $params[":$col"] = $val;
            }
            $params[':id'] = $id;
            $sql = "UPDATE `{$this->tbl_name}` SET " . implode(', ', $sets) . " WHERE `id` = :id";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute($params);
        }
       public function generate_user_id() {
            // Generate 16 bytes of random data
            $data = random_bytes(16);

            // Set version to 0100 (version 4)
            $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
            // Set bits 6-7 to 10
            $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

            // Format the string into the standard 8-4-4-4-12 UUID layout
            return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
        }

    }
    
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $lname  = trim($_POST['lname'] ?? '');
    $fname  = trim($_POST['fname'] ?? '');
    $gender = $_POST['gender'] ?? null;
    $network_leader_fname = $_POST['network_leader_fname'] ?? null;
    $network_leader_lname = $_POST['network_leader_lname'] ?? null;
    $student = new StudentInfo();
    $user_id = $student->generate_user_id();

    $insert_info = [ 
        "first_name"   => $fname,
        "last_name"    => $lname,
        "gender"       => $gender,
        "netlead_fname" => $network_leader_fname,
        "netlead_lname" => $network_leader_lname,
        "uid" => $user_id
    ];

    $student->insert_student_info($insert_info);
    header("Location: index.php");
    exit;
}
    
            




    





?>
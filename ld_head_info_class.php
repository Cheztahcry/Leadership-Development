<?php
    require_once 'Database.php';
    class OwnerInfo extends Database {
        private array $info_list;
        public function __construct() {
        parent::__construct();
    }
        public function insert_owner_info(array $insert_info){
            $this->insert_table($this->query_config['tables']['account'], $insert_info);
        }
        public function show_ownerinfo($id) {
            $sql = "SELECT * FROM `{$this->query_config['tables']['account']}` WHERE id = ? LIMIT 1";
            $stmt = $this->pdo->prepare($sql);          
            $stmt->execute([$id]);
            $user = $stmt->fetch(PDO::FETCH_OBJ);
            return $user;
        }

        public function update_owner(int $id, array $updates){
            if (empty($updates)) return false;
            $sets = [];
            $params = [];
            foreach ($updates as $col => $val) {
                $sets[] = "`$col` = :$col";
                $params[":$col"] = $val;
            }
            $params[':id'] = $id;
            $sql = "UPDATE `{$this->query_config['tables']['accounts']}` SET " . implode(', ', $sets) . " WHERE `id` = :id";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute($params);
        }
        public function duplicate_email($email){
            $sql = "SELECT 1 
            FROM `{$this->query_config['tables']['students']}` 
            WHERE email = :email
            LIMIT 1";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'email' => $email]);
            return (bool) $stmt->fetch();
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
    
    $lname = trim(($_POST['lname'] ?? null));
    $fname = trim(($_POST['fname'] ?? null));
    $email = trim(($_POST['email'] ?? null));
    $password = trim(($_POST['password'] ?? null));
    $confirm_password = trim(($_POST['confirm_password'] ?? null));
    $required_pass = 8;
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $owner = new OwnerInfo();
    $user_id = $owner->generate_user_id();
    
    $expected_fields = [
    'fname'            => 'First name is required.',
    'lname'            => 'Last name is required.',
    'email'            => 'Email is required.',
    'password'         => 'Password is required.',
    'confirm_password' => 'Please confirm your password.'
    ];
    $errors = [];
    foreach ($expected_fields as $field => $errorMessage) {
    $value = trim($_POST[$field] ?? '');
    
    if ($value === '') {
        $errors[$field] = $errorMessage;
    } else {
        $data_to_submit[$field] = $value;
    }
    }
    
    if (!isset($errors['password']) && !isset($errors['confirm_password'])) {
    if ($data_to_submit['password'] !== $data_to_submit['confirm_password']) {
        $errors['password_match'] = "Your passwords do not match!";
    }
    }

    

    if (empty($errors)) {
        $insert_info = [ 
                "first_name" => $fname,
                "last_name" => $lname,
                "email" => $email,
                "password" => $password_hash,
                "uid" => $user_id

                  ];  
        $owner = new OwnerInfo();
        try {
            $owner->insert_owner_info($insert_info);
            header("Location: index.php");
            exit;
        }catch(PDOException $e){
            if ($e->getCode() === '23000') {
               header('Location: error_page.php');
               exit;
            }
            
        }
        
        
    }



    





?>
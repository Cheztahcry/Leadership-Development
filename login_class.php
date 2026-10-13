<?php
    require_once __DIR__ . '/database.php';
    class AccountInfo extends Database {

        public function __construct() {
        parent::__construct();
        
        }
        public function delete_token(){
            $sql = "DELETE FROM {$this->query_config['tables']['remember_tokens']} WHERE account_id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$_SESSION['account_id']]);
            $_SESSION = array();
            session_destroy();
        }
        public function fetch_token($selector, $validator){
            $sql = "SELECT account_id, token FROM {$this->query_config['tables']['remember_tokens']} WHERE selector = :selector";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'selector' => $selector]);
            $saved_tokens = $stmt->fetch(PDO::FETCH_OBJ);

            foreach ($saved_tokens as $row) {
                if (password_verify($validator, $row->validator_hash)) {
                    session_regenerate_id(true);
                    $_SESSION['account_id'] = $row->account_id;
                    return true; 
                }
            }
            return false;
        }
        
        public function check_credentials($email, $password, $cookie) {
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $sql = "SELECT * FROM {$this->query_config['tables']['account']} WHERE email  = ? LIMIT 1";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_OBJ);
            if ($user) {
                if (password_verify($password, $user->password)) {
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                        session_regenerate_id();
                    }
                    if ($cookie) {
                            $selector = bin2hex(random_bytes(16));
                            $validator = bin2hex(random_bytes(32));
                            $stored_hash = password_hash($validator, PASSWORD_DEFAULT);
                            $cookie_value = $selector . ':' . $validator;
                            $expiry = time() + (30 * 24 * 60 * 60);
                            $expiry_date = date('Y-m-d H:i:s', $expiry);
                            $insert_info = [ 
                                "account_id" => $user->id,
                                "selector" => $selector,
                                "validator_hash" => $validator,
                                "expires_at" => $expiry_date
                            ];
                            $this->insert_table($this->query_config['tables']['remember_tokens'], $insert_info);
                            setcookie(
                                "remember_token",   // Name of the cookie
                                $cookie_value,      // The raw token value
                                $expiry,            // Expiration timestamp
                                "/",                // Available across your entire website
                                "",                 // Domain (blank for localhost)
                                false,              // Secure: change to true if using HTTPS
                                true                // HttpOnly: Prevents JavaScript/Hackers from reading it!
                            );
                        }
                    $_SESSION["account_id"] = $user->id;
                    return true;

                    
                } else {
                    return false;

                }
            } else {
                return false; 
            }
        }
        else{
            return false;
        }   
    }

}   





?>
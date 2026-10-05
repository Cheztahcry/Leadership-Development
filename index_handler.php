<?php
include_once __DIR__ .  '/ld_head_info_class.php';
include_once __DIR__ . '/login_class.php';
session_start();
class Index{
    private function user_cookies(){
        if (!isset($_SESSION['account_id']) && isset($_COOKIE['remember_token'])) {
        $cookie_token = $_COOKIE['remember_token'];
        $cookie_parts = explode(':', $cookie_token);
        list($selector, $validator) = $cookie_parts;
        $account = new AccountInfo();
        $cookies = $account->fetch_token($selector, $validator);
        return $cookies;
    }   
    }

    private function user_id(){
        if(isset($_SESSION["account_id"])){
            $owner = new OwnerInfo();
            $user = $owner->show_ownerinfo($_SESSION["account_id"]);
            return $user;
        }
    }

    public function ini_index(){
        $ini_cookie = null;
        $ini_id = null;
        
        
        try {
            $ini_cookie = $this->user_cookies();
            $ini_id = $this->user_id();
        }catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
        return $ini_id;

    }

}
?>

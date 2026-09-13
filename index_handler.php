<?php
include_once __DIR__ .  '/owner_info_class.php';
include_once __DIR__ . '/login_class.php';
class Index{
    private function user_cookies(){
        if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_token'])) {
        $cookie_token = $_COOKIE['remember_token'];
        $account = new AccountInfo();
        $cookies = $account->fetch_token();
        return $cookies;
    }   
    }

    private function user_id(){
        if(isset($_SESSION["user_id"])){
            $owner = new OwnerInfo();
            $user = $owner->show_ownerinfo($_SESSION["user_id"]);
            return $user;
        }
    }

    public function ini_index(){
        $ini_cookie = null;
        $ini_id = null;
        
        session_start();
        try {
            $ini_cookie = $this->user_cookies();
            $ini_id = $this->user_id();
        }catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
        return [
            'cookie' => $ini_cookie,
            'id' => $ini_id
        ];

    }

}


?>

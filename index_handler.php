<?php
namespace Handlers;
date_default_timezone_set('Asia/Manila');
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/error_logs/index_handler.txt');
include_once __DIR__ . '/login_class.php';
session_start();
use Services\StudentInfo;
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
            error_log("Database: " . $e->getMessage());
            die("Something went wrong. Please check back later.");
        }
        return $ini_id;

    }

}
?>

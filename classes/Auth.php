<?php

class Auth
{

    public static function isLoggedIn()
    {
        return isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'];
    }

    

    public static function requireLogin()
    {

        if (!static::isLoggedIn()) {
            die("Not Logged in");
        }
    }

    public static function login($username)
    {

        session_regenerate_id(true);

        $_SESSION['username']= $username;
        $_SESSION['is_logged_in'] = true;
    }

    public static function isAdminLoggedIn() {
        return isset($_SESSION['is_admin_logged_in']) && $_SESSION['is_admin_logged_in'];
    }


    public static function adminRequireLogin() {
        if(!static::isAdminLoggedIn()) {

            die("Login as Admin");
        }
    }

    public static function adminLogin($adminname) {

        session_regenerate_id(true);
        $_SESSION['adminname'] = $adminname;
        $_SESSION['is_admin_logged_in'] = true;
    }

    public static function logout()
    {

        $_SESSION = [];

        // If it's desired to kill the session, also delete the session cookie.
        // Note: This will destroy the session, and not just the session data!
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        session_destroy();
    }
}

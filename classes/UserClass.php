<?php
trait User
{
    public $username;
    public $password;
    public $email;
    public function addUser($connObj)
    {

            $col = [];
            $val = [];
            $user_name = $_POST["User_name"];
            $user_email =  $_POST["User_email"];
            $user_password =  $_POST["User_password"];
            
            $col = ['username', 'email', 'pswd', 'userrole'];
            $val = [$user_name, $user_email, md5($user_password), 'member'];
            $col = implode("`,`", $col);
            $val = implode("','", $val);

            echo $connObj->insert("users", $col, $val);
    }
    public function checkUser($connObj){
            
            $user_name = $_POST["User_name"];
            $user_password = $_POST["User_password"];
            $user_email = $_POST["User_email"];        
            $col = ['username', 'email', 'pswd', 'userrole'];
            $col = implode(",", $col);
            $para = "WHERE username='" . $user_name . "' AND pswd='" . md5($user_password) . "' AND email='" . $user_email . "'";

            $temp = $connObj->selectQuery('users', $col, $para);

            if ($temp) {
                
                $row = $temp[0];
                session_start();
                $_SESSION["NAME"] = $row["username"];
                $_SESSION["EMAIL"] = $row["email"];
                $_SESSION["ROLE"] = $row["userrole"];

                return  '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Hurry!! Login Successful.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';

            } else { return '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                Hurry!! Login Unsuccessful.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'; }
    }

}
?>
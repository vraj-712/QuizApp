<?php
include("ConnectionClass.php");
include("QuizClass.php");
include("UserClass.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';


$mail = new PHPMailer(true);

class Ajax extends Quiz
{
    use User;
    public function __construct( $connObj ){

        $this->connObj = $connObj;
        $action = null;
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $action = isset($_POST["action"])?$_POST["action"]:null;
            if(method_exists($this,$action))
            {
                echo $this->$action($_POST);
            }
        }
        elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
            $action = isset($_GET["action"])?$_GET["action"]:null;
            if(method_exists($this,$action))
            {
                echo $this->$action($_GET);
            }
        }
        else{ $action = null; }
        parent::__construct($this->connObj);
        

    }
    public function addOptionAjax(){

            $col = [];
            $user_qid = isset($_POST["qid"]) ? $_POST["qid"] : null;
            $user_flag = isset($_POST["flag"]) ? $_POST["flag"] : null;
            $user_data = isset($_POST["data"]) ? $_POST["data"] : null;

            $col = ['opt1', 'opt2', 'opt3', 'opt4', 'ans'];
            $col = implode(',', $col);
            $para = "WHERE qno=" . "'" . $user_qid . "'";

            $temp = $this->connObj->selectQuery('questions', $col, $para);

            QUIZ::addOption($temp, $user_qid, $user_flag, $user_data);
    }

    public function addQuestionAjax(){

            $col = [];
            $val = [];
            
            $user_question = isset($_POST["uquestion"]) ? $_POST["uquestion"] : null;
            $user_options = isset($_POST["opts"]) ? $_POST["opts"] : array_fill(0, 4, null);
            $user_answer = isset($_POST["rightans"]) ? $_POST["rightans"] : null;
            
            $col = ['question', 'opt1', 'opt2', 'opt3', 'opt4', 'ans'];
            $val = [$user_question, $user_options[0], $user_options[1], $user_options[2], $user_options[3], $user_answer];
            $col = implode("`,`", $col);
            $val = implode("','", $val);

            echo $this->connObj->insert('questions', $col, $val, null);
    }
    public function getHistoryAjax(){

            session_start();
            $col = ["usertime", "score", "email"];
            $col = implode(",", $col);
            $para = "WHERE " . "email=" . "'" . $_SESSION['EMAIL'] . "'";
            $temp = $this->connObj->selectQuery('usershistory', $col, $para);
            
            echo $this->getHistory($temp);
    }

    public function fetchAllAjax(){

            $temp = $this->connObj->selectQuery('questions');
            echo $this->fetchAllQuestion($temp);
    }
    public function fetchAjax(){
 
            $para = "ORDER BY RAND() LIMIT 10";
            $temp = $this->connObj->selectQuery('questions', "*", $para);

            echo $this->fetchTenQuestion($temp);
    }
    public function deleteOptionAjax(){

            $user_qid = isset($_POST["qid"]) ? $_POST["qid"] : null;
            $user_data = isset($_POST["data"]) ? $_POST["data"] : null;

            echo $this->deleteOption($user_qid, $user_data);

    }

    public function changeAnsAjax(){

            $user_qid = isset($_POST["qid"]) ? $_POST["qid"] : null;
            $user_data = isset($_POST["data"]) ? $_POST["data"] : null;
            echo $this->changeAnswerValue($user_qid, $user_data);
    }
    public function changeAnsValueAjax(){

            $col = [];
            
            $user_qid = isset($_POST["qid"]) ? $_POST["qid"] : null;
            $user_data = isset($_POST["data"]) ? $_POST["data"] : null;
            $user_new_opt = isset($_POST["newoption"]) ? $_POST["newoption"] : null;
            
            $col = ['opt1', 'opt2', 'opt3', 'opt4', 'ans'];
            $col = implode(',', $col);
            $para = "WHERE qno='" . $user_qid . "'";
            $temp = $this->connObj->selectQuery("questions", $col, $para);

            echo $this->changeOptionValue($temp, $user_qid, $user_data, $user_new_opt);
    }
    public function addUserAjax(){ $this->addUser( $this->connObj ); }

    public function checkQuizAjax(){

            $answer_arr = $_POST["user_result"];

            $temp = $this->checkQuiz($answer_arr);
            $to = $_SESSION["EMAIL"];
            $subject = "Your Quiz Result";
            $txt = "You have scored " . $temp . " / 10 ";
            
            try {
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = "smtp.gmail.com";
                $mail->SMTPAuth = true;
                $mail->Username = "patelvraju07@gmail.com";
                $mail->Password = "dvffxqbjrndjjten";
                $mail->SMTPSecure = "ssl";
                $mail->Port = 465;

                $mail->setfrom("patelvraju07@gmail.com");
                $mail->addAddress($to);
                $mail->Subject = $subject;
                $mail->Body = $txt;
                $mail->send();
            } catch (Exception $e) {
                echo $e;
            }
            echo $temp;
    }
    public function checkUserAjax(){ echo $this->checkUser($this->connObj); }
}
$connObj = new DataBase("localhost","vraj","","quiz");
$ajaxObj = new Ajax($connObj);
?>
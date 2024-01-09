<?php
class Quiz
{
    public $question;
    public $option1;
    public $option2;
    public $option3;
    public $option4;
    public $option5;
    public $ans;
    public $connObj;
    public function __construct($connObj, $question = null, $option1 = null, $option2 = null, $option3 = null, $option4 = null, $ans = null)
    {
        $this->connObj = $connObj;
        $this->question = $question;
        $this->option1 = $option1;
        $this->option2 = $option2;
        $this->option3 = $option3;
        $this->option4 = $option4;
        $this->ans = $ans;
    }
    public function fetchAllQuestion($arr)
    {
        ob_start();
        ?>
        <tr style='border:5px solid black;'>
            <th>Question No</th>
            <th>Question</th>
            <th>Option1</th>
            <th>Option2</th>
            <th>Option3</th>
            <th>Option4</th>
            <th>Answer</th>
        </tr>;
        <?php

        foreach ($arr as $row) {
            ?>
            <tr style='border:5px solid black;'>
                <td><?php echo $row["qno"] ?></td>
                <td style='width:23%'><?php echo $row["question"] ?></td>

                <?php
                if (($row["opt1"]) == Null) {
                    ?>
                    <td>
                        <div class='input-group w-100 option'>
                            <input type='radio' class='me-3 ms-3 input-group-radio ans' name='option'></input>
                            <input type='text' width='100%' class='form-control opt' placeholder='option'>
                            <button id='add' data-id=<?php echo $row["qno"] ?>>ADD</button>
                        </div>
                    </td>
                    <?php } else { ?>
                        
                    <td>
                        <div>
                            <?php echo $row["opt1"] ?>
                        </div>
                        <button id='del' data-id=<?php echo $row["qno"] ?>>Remove</button> 
                        <button id='chng' data-id=<?php echo $row["qno"] ?>>Edit</button> 
                        <button id='correctans' data-id=<?php echo $row["qno"] ?>>Answer</button>
                    </td>

                    <?php } if (($row["opt2"]) == Null) { ?>

                    <td>
                        <div class='input-group w-100 option'>
                            <input type='radio' class='me-3 ms-3 input-group-radio ans' name='option'></input>
                            <input type='text' width='100%' class='form-control opt' placeholder='option'>
                            <button id='add' data-id=<?php echo $row["qno"] ?>>ADD</button>
                        </div>
                    </td>

                    <?php } else { ?>

                    <td>
                        <div>
                            <?php echo $row["opt2"] ?>
                        </div> <button id='del' data-id=<?php echo $row["qno"] ?>>Remove</button> <button id='chng' data-id=<?php echo $row["qno"] ?>>Edit</button> <button id='correctans' data-id=<?php echo $row["qno"] ?>>Answer</button>
                    </td>

                    <?php } if (($row["opt3"]) == Null) { ?>
                        
                    <td>
                        <div class='input-group w-100 option'>
                            <input type='radio' class='me-3 ms-3 input-group-radio ans' name='option'></input>
                            <input type='text' width='100%' class='form-control opt' placeholder='option'>
                            <button id='add' data-id=<?php echo $row["qno"] ?>>ADD</button>
                        </div>
                    </td>

                    <?php } else { ?>

                    <td>
                        <div>
                            <?php echo $row["opt3"] ?>
                        </div>
                        <button id='del' data-id=<?php echo $row["qno"] ?>>Remove</button>
                        <button id='chng' data-id=<?php echo $row["qno"] ?>>Edit</button>
                        <button id='correctans' data-id=<?php echo $row["qno"] ?>>Answer</button>
                    </td>

                    <?php } if (($row["opt4"]) == null) { ?>

                    <td>
                        <div class='input-group w-100 option'>
                            <input type='radio' class='me-3 ms-3 input-group-radio ans' name='option'></input>
                            <input type='text' class='form-control opt' placeholder='option'>
                            <button id='add' data-id=<?php echo $row["qno"] ?>>ADD</button>
                        </div>
                    </td>

                    <?php } else { ?>
                        
                    <td>
                        <div>
                            <?php echo $row["opt4"] ?>
                        </div> <button id='del' data-id=<?php echo $row["qno"] ?>>Remove</button> <button id='chng' data-id=<?php echo $row["qno"] ?>>Edit</button> <button id='correctans' data-id=<?php echo $row["qno"] ?>>Answer</button>
                    </td>

                    <?php } ?>

                <td style='width:7%'>
                    <?php echo $row["ans"] ?>
                </td>
            </tr>
            <?php }
        $txt = ob_get_clean();

        return $txt;
    }
    public function deleteOption($user_qid, $user_data){

        $para = "WHERE qno='" . $user_qid . "'";
        $result = $this->connObj->selectQuery('questions', implode(',', ['opt1', 'opt2', 'opt3', 'opt4', 'ans']), $para);
        
        if ($result) {
            $row = $result[0];
            if ($row["ans"] == $user_data) {
                
                return "You Can Not Delete Answer .";
                
            } else {
                
                if (($row["opt3"] == "" && $row["opt4"] == "") || ($row["opt3"] == null && $row["opt4"] == "") || ($row["opt3"] == "" && $row["opt4"] == null) || ($row["opt3"] == null && $row["opt4"] == null)) {

                    return "Minimum Two Option Required .";
                    
                } else {
                    
                    if ($row["opt1"] == $user_data) {

                        $data = ["opt1" => $row["opt2"], "opt2" => $row["opt3"], "opt3" => $row["opt4"], "opt4" => ""];
                        $para = ["qno" => $user_qid];
                        $this->connObj->update("questions", $data, $para);
                        
                    } else if ($row["opt2"] == $user_data) {

                        $data = ["opt2" => $row["opt3"], "opt3" => $row["opt4"], "opt4" => ""];
                        $para = ["qno" => $user_qid];
                        $this->connObj->update("questions", $data, $para);
                        
                    }
                    if ($row["opt3"] == $user_data) {

                        $data = ["opt3" => $row["opt4"], "opt4" => ""];
                        $para = ["qno" => $user_qid];
                        $this->connObj->update("questions", $data, $para);
                        
                    } else {

                        $data = ["opt4" => ""];
                        $para = ["qno" => $user_qid];
                        $this->connObj->update("questions", $data, $para);

                    }

                    return "Deleted Successfully !!";
                }

            }
        }
    }

    public function addOption($arr, $user_qid, $user_flag, $user_data){

        if ($arr) {
            $row = $arr[0];
            
            if ($row["opt2"] == null) {
                
                if ($user_flag === 'true') {
                    
                    $data = ['opt2' => $user_data, 'ans' => $user_data];
                    $para = ['qno' => $user_qid];
                    $this->connObj->update("questions", $data, $para);

                } else {
                    
                    $data = ['opt2' => $user_data];
                    $para = ['qno' => $user_qid];
                    $this->connObj->update("questions", $data, $para);

                }
            } else if ($row["opt3"] == null) {

                if ($user_flag === 'true') {
                
                    $data = ['opt3' => $user_data, 'ans' => $user_data];
                    $para = ['qno' => $user_qid];
                    $this->connObj->update("questions", $data, $para);
                } else {
                    
                    $data = ['opt3' => $user_data];
                    $para = ['qno' => $user_qid];
                    $this->connObj->update("questions", $data, $para);

                }
            } else if ($row["opt4"] == null) {

                if ($user_flag === 'true') {
                
                    $data = ['opt4' => $user_data, 'ans' => $user_data];
                    $para = ['qno' => $user_qid];
                    $this->connObj->update("questions", $data, $para);
                    
                } else {

                    $data = ['opt4' => $user_data];
                    $para = ['qno' => $user_qid];
                    $this->connObj->update("questions", $data, $para);

                }

            }
        }
    }
    public function fetchTenQuestion($arr){

        foreach ($arr as $row) {
            
            $qno = $row["qno"];
            $question = $row["question"];
            $opt1 = $row["opt1"];
            $opt2 = $row["opt2"];
            $opt3 = $row["opt3"];
            $opt4 = $row["opt4"];
            $questions[] = array('qno' => $qno, 'question' => $question, 'opt1' => $opt1, 'opt2' => $opt2, 'opt3' => $opt3, 'opt4' => $opt4);

        }

        return json_encode($questions);
    }

    public function checkQuiz($answer_arr){
        
        $count = 0;
        for ($i = 0; $i < 10; $i++) {
            
            $question_no = $answer_arr[$i]["qno"];
            $result = $this->connObj->selectQuery('questions', implode(',', ['qno', 'ans']), "WHERE qno='" . $question_no . "'");
            if ($result) {
                $row = $result[0];

                if ($row['ans'] == $answer_arr[$i]['ans']) { $count += 1; }
            }
        }
        
        session_start();
        $temp = $_SESSION['EMAIL'];
        $name = $_SESSION['NAME'];
        $val = $count . "','" . $temp;

        $result = $this->connObj->insert('usershistory', implode("`,`", ['score', 'email']), $val);

        if ($result === TRUE) { return $count;  }
    }
    public function getHistory($arr){

        ob_start();
        ?>
        
        <tr style='border-bottom:3px solid black; background-color:blue;'>";
            <th>Date & Time</th>";
            <th>Result</th>";
            <th>Email</th>";
        </tr>
        
        <?php foreach ($arr as $row) { ?>

            <tr>
                <td>
                    <?php echo $row['usertime']; ?>
                </td>";
                <td>
                    <?php echo $row['score']; ?>
                </td>";
                <td>
                    <?php echo $row['email']; ?>
                </td>";
            </tr>
            
            <?php }
        $txt = ob_get_clean();
        echo "1111";
        return $txt;
    }
    public function changeOptionValue($arr, $user_qid, $user_data, $user_new_opt){

        if ($arr) {
            $row = $arr[0];
            
            if ($row["opt1"] == $user_data) {
                
                if ($row["ans"] == $user_data) {

                    $data = ['opt1' => $user_new_opt, 'ans' => $user_new_opt];
                    $para = ['qno' => $user_qid];
                    $this->connObj->update("questions", $data, $para);
                    
                } else {
                    
                    $data = ['opt1' => $user_new_opt];
                    $para = ['qno' => $user_qid];
                    $this->connObj->update("questions", $data, $para);

                }
            } else if ($row["opt2"] == $user_data) {
                
                if ($row["ans"] == $user_data) {

                    $data = ['opt2' => $user_new_opt, 'ans' => $user_new_opt];
                    $para = ['qno' => $user_qid];
                    $this->connObj->update("questions", $data, $para);

                } else {
                    
                    $data = ['opt2' => $user_new_opt];
                    $para = ['qno' => $user_qid];
                    $this->connObj->update("questions", $data, $para);

                }
            } else if ($row["opt3"] == $user_data) {
                
                if ($row["ans"] == $user_data) {

                    $data = ['opt3' => $user_new_opt, 'ans' => $user_new_opt];
                    $para = ['qno' => $user_qid];
                    $this->connObj->update("questions", $data, $para);

                } else {
                    
                    $data = ['opt3' => $user_new_opt];
                    $para = ['qno' => $user_qid];
                    $this->connObj->update("questions", $data, $para);

                }
            } else {

                if ($row["ans"] == $user_data) {
                
                    $data = ['opt4' => $user_new_opt, 'ans' => $user_new_opt];
                    $para = ['qno' => $user_qid];
                    $this->connObj->update("questions", $data, $para);

                } else {

                    $data = ['opt4' => $user_new_opt];
                    $para = ['qno' => $user_qid];
                    $this->connObj->update("questions", $data, $para);
                }

            }

            return "Option Changed.";
        }
    }
    public function changeAnswerValue($user_qid, $user_data){

        $data = ['ans' => $user_data];
        $para = ['qno' => $user_qid];

        if ($this->connObj->update("questions", $data, $para) === TRUE) { return "Answer Updated."; }
        
    }
}
?>
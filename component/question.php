<?php
include("navbar.php");
if (isset($_SESSION["ROLE"])) {
    if ($_SESSION["ROLE"] == 'admin') {
            
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

            <!-- Latest compiled JavaScript -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

            <script src="https://code.jquery.com/jquery-3.5.0.js"></script>

            <style>
                .content {
                    position: relative;
                    border: 5px solid black;
                    width: 750px;
                    height: 450px;
                    margin: 50px auto;
                    background-color: whitesmoke;
                }
                
                h3,
                h4 {
                    background-color: #414a4c;
                    color: red;
                    text-align: center;
                    padding: 5px;
                    color: whitesmoke
                }

                .question-content {
                    text-align: center;
                }

                #question {
                    width: 90%;
                    margin: 15px;
                    background-color: whitesmoke;
                    border: 0px;
                }

                div.option {
                    /* background-color: lightblue; */
                    border-radius: 15px;
                    margin: 10px 0;
                }

                #submitQuestion {
                    margin: 15px 15px;
                    padding: 7px;
                    border-radius: 10px;
                    background-color: green;
                    border: 3px solid #414a4c;
                    color: white;
                }

                textarea {
                    max-height: 150px;
                }

                #del,
                #chng,
                #correctans {
                    padding: 0;
                    font-size: 10px;
                    background-color: red;
                    color: white;
                    padding: 5px;
                    border-radius: 25px;
                    font-weight: bold;
                }
            </style>
        </head>

        <body>

            <?php
            if (isset($_SESSION["ROLE"])) {
                if ($_SESSION["ROLE"] == "admin") {
                    ?>
                    <div class="content">
                        <h3>Add Questions</h3>
                        <div class="question-content">
                            <textarea name="question" id="question" cols="50" rows="5" placeholder="Add Question Here...."
                                fixed></textarea>
                        </div>
                        <h4>Add Options</h4>
                        <div class="container me-auto ms-auto options me-auto ms-auto">
                            <div class="input-group w-50 option">
                                <input type="radio" class="ms-3 me-3 input-group-radio ans" name="option"></input>
                                <input type="text" class="form-control opt" placeholder="option">
                            </div>
                            <div class="input-group w-50 option">
                                <input type="radio" class="me-3 ms-3 input-group-radio ans" name="option"></input>
                                <input type="text" class="form-control opt" placeholder="option">
                            </div>
                        </div>
                        <button id="submitQuestion">Add Question</button>
                    </div>
                    <table border="1" width="100%" class="tab table-bordered" id="myTable" cell-spacing="5px" cell-padding="5px">
                        <tbody id="innerTable">
                        </tbody>
                    </table>
                    <?php

                }
            }
            ?>
            <script>
                $(document).ready(function () {
                    function fetchAllData() {
                        $.ajax({
                            type: "GET",
                            url: "/quizapp/classes/AjaxRequestClass.php",
                            data:{action:'fetchAllAjax'},
                            success: function (response) {
                                $("#innerTable").html(response);
                                $("tr:first-child").css({
                                    "text-align":"center",
                                    "height":"65px",
                                    "background-color":"#414a4c",
                                    "font-size":"1.2em",
                                })
                                $("tr:first-child>th").css({
                                    "color":"#f5f5f5",
                                })
                                $("table").css({
                                    "border-width":"5px",
                                })
                                $("tr td:first-child").css({
                                    "width":"8%",
                                    "text-align":"center",
                                });
                                $("tr td:nth-child(2)").css({
                                    "width":"20%",
                                    "text-align":"center",
                                    "padding":"15px",
                                });
                                $("tr td:nth-child(3)").css({
                                    "width":"15%",
                                    "text-align":"center",
                                    "padding":"15px",
                                });
                                $("tr td:nth-child(4)").css({
                                    "width":"15%",
                                    "text-align":"center",
                                    "padding":"15px",
                                });
                                $("tr td:nth-child(5)").css({
                                    "width":"15%",
                                    "text-align":"center",
                                    "padding":"15px",
                                });
                                $("tr td:nth-child(6)").css({
                                    "width":"15%",
                                    "text-align":"center",
                                    "padding":"15px",
                                });
                                $("tr td:nth-child(7)").css({
                                    "width":"15%",
                                    "text-align":"center",
                                    "padding":"15px",
                                });
                            }
                        });


                    }
                    fetchAllData();
                    $(document).on('click', '#submitQuestion', function () {
                        let question = $("#question").val();
                        let options = $(".opt")
                        let answers = $(".ans")
                        let allOptions = [];
                        let rightAnswer = undefined;
                        for (let i = 0; i < options.length; i++) {
                            allOptions.push($(options[i]).val())
                        }
                        let i = 0;
                        Array.from(answers).forEach((element) => {
                            if (element.checked) {
                                rightAnswer = allOptions[i]
                            }
                            i++;
                        })
                        if (rightAnswer) {

                            $.ajax({
                                type: "POST",
                                url: "/quizapp/classes/AjaxRequestClass.php",
                                data: { uquestion: question, opts: allOptions, rightans: rightAnswer,action:'addQuestionAjax' },
                                success: function (response) {
                                   window.location.reload()
                                    fetchAllData();
                                }
                            });
                        }
                        else {
                            alert("Answer Required !!");
                        }

                    })
                    $(document).on('click', '#add', function () {
                        let qid = $(this).data("id");
                        let flag = ($(this).parent().children().first().is(':checked'))
                        let data = $($(this).parent().children()[1]).val();
                        data = data.trim();
                        if (data=="" || data== null)
                        {
                            alert("Value Can Not Be Empty !!");
                        } else {

                            $.ajax({
                                type: "POST",
                                url: "/quizapp/classes/AjaxRequestClass.php",
                                data: { qid: qid, flag: flag, data: data ,action:'addOptionAjax'},
                                success: function (response) {
                                    alert("Option Value Added.")
                                    fetchAllData();
    
                                }
                            });
                        }


                    })
                    $(document).on('click', '#del', function () {
                        let qid = $(this).data("id");
                        let data = $($(this).parent().children()[0]).text();
                        data = data.trim();
                        $.ajax({
                            type: "POST",
                            url: "/quizapp/classes/AjaxRequestClass.php",
                            data: { qid: qid, data: data,action:'deleteOptionAjax' },
                            success: function (response) {
                                if (response == "You Can Not Delete Answer .") {
                                    alert(response)
                                }
                                else if (response == "Minimum Two Option Required .") {
                                    alert(response)
                                }
                                else {
                                    alert(response)
                                    fetchAllData();
                                }

                            }
                        });


                    })
                    $(document).on('click', '#chng', function () {
                        let qid = $(this).data("id");
                        let data = $($(this).parent().children()[0]).text();
                        data = data.trim();
                        let newOptionVal = prompt("Enter Value");
                        if(data == "" ||data == null){

                            alert("New Value Can Not Be Empty !!");
                            
                        }else {
                            
                            $.ajax({
                                type: "POST",
                                url: "/quizapp/classes/AjaxRequestClass.php",
                                data: { qid: qid, data: data, newoption: newOptionVal, action:'changeAnsValueAjax' },
                                success: function (response) {
                                    if (response == "Option Changed.") {
                                        alert(response)
                                        fetchAllData()
                                    }
    
                                }
                            });

                        }
                    })
                    $(document).on('click', "#correctans", function () {
                        let qid = $(this).data("id");
                        let data = $($(this).parent().children()[0]).text();
                        data = data.trim();
                        $.ajax({
                            type: "POST",
                            url: "/quizapp/classes/AjaxRequestClass.php",
                            data: { qid: qid, data: data ,action:'changeAnsAjax'},
                            success: function (response) {
                                if (response == "Answer Updated.") {
                                    alert(response)
                                    fetchAllData()
                                }

                            }
                        });

                    })
                })
            </script>

        </body>

        </html>

        <?php
    }
    else {
        header("Location:/quizapp/index.php", true);
    }
} else {
    header("Location:/quizapp/component/loginpage.php", true);
}
?>
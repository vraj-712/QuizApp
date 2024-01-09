<?php
session_start();
if (isset($_SESSION["ROLE"]) ) {
    session_abort();
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
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80%;
            border: 2px solid black;
            padding: 15px;
        }

        #submitQuiz {
            color: white;
            font-size: 20px;
            background-color: green;
            text-align: center;
            border: 3px solid black;
            width: 100%;
            border-radius: 25px;
            width: 30%;
            box-shadow:4px 5px 10px black;
        }

        div.content>div {
            padding: 15px;
        }

        .buttons {

            margin: 25px 0;
        }

        #next,
        #prev {
            display: inline;
            padding: 5px 10px;
            color: white;
            font-size: 15px;
            font-weight: bold;
            border-radius: 25px;
            background-color: gray;
            border: 5px solid black;
        }

        #next {
            float: right;
        }

        #prev {
            float: left;
        }

        #question {
            font-size: 25px;
        }

        .qno {
            display: inline;
            float: right;
        }

        .option1container,
        .option3container,
        .option4container,
        .option2container,
        .result-container {
            display: none;
        }

        .result-container {
            position: absolute;
            width: 500px;
            height: 250px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            border: 2px solid black;
        }

        .result-container h1 {
            margin-top: 43px;
        }

        #restatQuiz {
            padding: 10px;
            position: relative;
            bottom: -20%;
            width: 50%;
            /* margin-top: 50px; */
            background-color: green;
            color: white;
            border: 3px solid black;
            font-size: 22px;
        }
    </style>

    </head>
    <body>
        <?php
        include("navbar.php");
        
        if (isset($_SESSION["ROLE"])) {
            ?>
            <div class="content container">
                <div class="qno"></div>
                <div id="question"></div>
                <div class="optionField">
                    <div class="option1container">
                        <input type="radio" name="option" id="option1" class="optans">
                        <label for="option1" id="label1"></label>
                    </div>
                    <div class="option2container">
                        <input type="radio" name="option" id="option2" class="optans">
                        <label for="option2" id="label2"></label>
                    </div>
                    <div class="option3container">
                        <input type="radio" name="option" id="option3" class="optans">
                        <label for="option3" id="label3"></label>
                    </div>
                    <div class="option4container">
                        <input type="radio" name="option" id="option4" class="optans">
                        <label for="option4" id="label4"></label>
                    </div>
                </div>
                <div class="buttons container">
                    <button id="next">Next</button>
                    <button id="prev">Prev</button>
                </div>
                <button class="container" id="submitQuiz">SUBMIT</button>
            </div>
            <div class="result-container">
                <h1 class="text-center" id="result">Result</h1>
                <button id="restatQuiz">Restart</button>
            </div>
            <?php
        }
        ?>
        <script>
            $(document).ready(function () {
                let data;
                let i = 0;
                let recordarr = [];
                for (let i = 0; i < 10; i++) {
                    recordarr.push({ "ans_input_field": null, "ans": null, "qno": null })
                }
                function fetchTenQuestion() {
                    $.ajax({
                        type: "GET",
                        url: "/quizapp/classes/AjaxRequestClass.php",
                        dataType: "json",
                        data:{action:'fetchAjax'},
                        success: function (response) {
                            if(response)
                            {

                                datagetting(response)
                            }
                            else
                            {
                                alert("No Question Found.")
                            }
                        }
                    })

                }
                fetchTenQuestion();
                function datagetting(response) {
                    data = response;
                    for (let x = 0; x < data.length; x++) {
                        let optarr = [data[x]["opt1"], data[x]["opt2"], data[x]["opt3"], data[x]["opt4"]]
                        let shufflearr = shuffle(optarr)
                        data[x]["opt1"] = shufflearr[0];
                        data[x]["opt2"] = shufflearr[1];
                        data[x]["opt3"] = shufflearr[2];
                        data[x]["opt4"] = shufflearr[3];

                    }
                    display();
                }
                function display() {


                    $("#question").html(data[i]["question"]);

                    if (data[i]["opt1"] == null || data[i]["opt1"] == "") {
                        $("div.option1container").first().css("display", "none")
                    }
                    else {
                        $("div.option1container").css("display", "block")
                        $("#option1").val(data[i]["opt1"])
                        $("#label1").html(data[i]["opt1"])

                    }
                    if (data[i]["opt2"] == null || data[i]["opt2"] == "") {
                        $("div.option2container").first().css("display", "none")
                    }
                    else {
                        $("div.option2container").css("display", "block")
                        $("#option2").val(data[i]["opt2"])
                        $("#label2").html(data[i]["opt2"])

                    }

                    if (data[i]["opt3"] == null || data[i]["opt3"] == "") {
                        $("div.option3container").first().css("display", "none")
                    }
                    else {
                        $("div.option3container").css("display", "block")
                        $("#option3").val(data[i]["opt3"])
                        $("#label3").html(data[i]["opt3"])

                    }
                    if (data[i]["opt4"] == null || data[i]["opt4"] == "") {
                        $("div.option4container").css("display", "none")
                    }
                    else {
                        $("div.option4container").css("display", "block")
                        $("#option4").val(data[i]["opt4"])
                        $("#label4").html(data[i]["opt4"])

                    }

                    $("div.qno").html(i + 1 + "/10")
                    if (i == 0) {
                        $("#prev").css("display", "none");
                    }
                    else {
                        $("#prev").css("display", "inline");
                    }
                    if (i == 9) {
                        $("#next").css("display", "none");
                    }
                    else {

                        $("#next").css("display", "inline");
                    }

                }

                const answer = $(".optans")
                Array.from(answer).forEach((Element) => {
                    Element.addEventListener("change", function (e) {
                        let obj = {}
                        obj['ans_input_field'] = e.target;
                        obj['ans'] = e.target.value;
                        obj['qno'] = data[i]["qno"];
                        recordarr[i] = obj;

                    })
                })
                $("#next").on("click", function () {
                    i += 1;
                    removeselection();
                    if (recordarr[i]['ans_input_field']) {
                        let check = recordarr[i]['ans_input_field']
                        $(check).prop('checked', true)

                    }
                    display();
                })
                $("#prev").on("click", function () {
                    i -= 1;
                    removeselection();
                    if (recordarr[i]['ans_input_field']) {
                        let check = recordarr[i]['ans_input_field']
                        $(check).prop('checked', true)

                    }
                    display()
                })
                function removeselection() {
                    $("[name='option']").prop('checked', false)

                }

                $("#submitQuiz").on('click', function () {
                    let temparr = []
                    let temp = JSON.stringify(recordarr)
                    for (let i = 0; i < 10; i++) {
                        let obj = {}
                        obj['ans'] = recordarr[i]['ans'];
                        obj['qno'] = recordarr[i]['qno'];
                        temparr.push(obj);

                    }
                    $.ajax({
                        type: "POST",
                        url: "/quizapp/classes/AjaxRequestClass.php",
                        data: { user_result: temparr ,action:'checkQuizAjax'},
                        success: function (response) {
                            $(".content").css("display", "none")
                            $(".result-container").css("display", "block");
                            $("#result").text("Result : " + response + "/10");

                        }
                    });
                })
                $(document).on('click', "#restatQuiz", function () {
                    window.location.reload(0)
                })


                function shuffle(array) {
                    let currentIndex = array.length, randomIndex;
                    while (currentIndex > 0) {
                        randomIndex = Math.floor(Math.random() * currentIndex);
                        currentIndex--;
                        
                        [array[currentIndex], array[randomIndex]] = [
                            array[randomIndex], array[currentIndex]];
                    }

                    return array;
                }
            })
        </script>

    </body>

    </html>
<?php
}else {
    header("Location:/quizapp/component/loginpage.php",true);
}
?>
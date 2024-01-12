<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: white;
        }
        .hero-section1
        {
            position: relative;
            height: 650px;
            background-color:lightblue;
            width: 100%;
        }
        .hero-section {
            position: relative;
            height: 750px;
            background-color: lightgoldenrodyellow;
            width: 100%;
        }
        .hero-section>.content
        {
            font-size: 35px;
            text-align: center;
        }
        .hero-section1>.content1
        {
            font-size: 65px;
            text-align: center;
        }

        .hero-section>.content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .hero-section1>.content1 {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .footer-section {
            /* position: fixed; */
            bottom: 0px;
            background-color: #414a4c;
            width: 100%;
            color: white;
        }

        .footer-section>.content {
            width: 65%;
            font-size: 0.9em;
            padding: 5px 0;
            text-align: center;
            margin: 0 auto;
        }
    </style>
</head>

<body>

    <div class="hero-section1">
        <div class="content1">
            <p class="line">Welcome To Quiz App</p>
        </div>
    </div>
    <div class="hero-section">
        <div class="content">
            <p class="quote">Challenge your mind, fuel your curiosity. Welcome to the world of quizzes!</p>
        </div>
    </div>
    <div class="footer-section">
        <div class="content">
            <p>Copyright &copy; 2024 by Vraj Patel</p>
            <p>All rights reversed. No part of this website may be reproduced or used in any manner without written
                permission of the copyright owner except for the use of quotation in website review.</p>
        </div>
    </div>
    <script>
        $(document).ready(function () {

            let taglines = [
                "Challenge your mind, fuel your curiosity. Welcome to the world of quizzes!",
                "Unlock knowledge, one question at a time. Your quiz adventure starts here.",
                "Quiz time: where curiosity meets entertainment, and knowledge is the key.",
                "Explore, Learn, Quiz. Dive into a world of endless knowledge and fun.",
                "Quiz your way to brilliance! Let the journey of learning and discovery begin.",
                "Discover the joy of learning through quizzes. Because every question is an opportunity.",
                "Welcome to our quiziverse – where questions spark curiosity and answers light up your knowledge.",
                "In the quest for knowledge, quizzes are the compass. Let the exploration begin!",
                "Turn your curiosity into points. Play, learn, conquer!",
                "Quiz your brain, spark your imagination. Unleash the power of knowledge."
            ];
            setInterval(() => {
                
                $(".quote").text(taglines[Math.floor(Math.random() * taglines.length)]);
            },2000);
        })
    </script>
</body>

</html>
<?php session_start(); ?>
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
    .custom-nav
    {
      position: relative;
      height: 70px;
      width: 100%;
      display: flex;
      align-items: center;
      background-color: #414a4c;
      padding-top: 10px;

    }
    .custom-menu
    {
      margin-left: auto;
      margin-right: 1em;
    }
    .custom-logo
    {
      margin-left:0px ;
    }
    .custom-logo li
    {
      font-size: 1.2em;
    }
    .custom-lists
    {
      list-style-type: none;
    }
    .custom-list
    {
      color: white;
      display: inline;
      margin: 0 10px;
    }
    .custom-link
    {
      text-decoration: none;
      color:white;
      font-size: 1.2em;
      padding: 7px;
      background-color: none;
      border-radius: 25px;
      /* transition: background-color 0.3s,color 0.5s; */
    }
    .custom-link:hover
    {
      background-color: lightcyan;
      color: #414a4c;
    }
    

    
    
  </style>
</head>

<body>
  <?php
  if (isset($_SESSION["ROLE"])) {
    if ($_SESSION["ROLE"] == "admin") {
      ?>
  
      <div class="custom-nav">
      <div class="custom-logo">
        <ul class="custom-lists">
          <li class="custom-list"><a class="custom-link" href="/quizapp/index.php">Quiz</a></li>
        </ul>
      </div>
      <div class="custom-menu">
        <ul class="custom-lists">
        <li class="custom-list">
                <a class="custom-link" href="/quizapp/component/Question.php">Add Questions</a>
              </li>
          <li class="custom-list"> <a class="custom-link" href="/quizapp/component/attempt.php">Attempt Quiz</a></li>
          <li class="custom-list"> <a class="custom-link" href="/quizapp/component/history.php">Quiz History</a></li>
          <li class="custom-list"> <a class="custom-link" href="/quizapp/component/logout.php">Logout</a></li>
          <li class="custom-list">{ <?php
                echo strtoupper($_SESSION["NAME"])." - ".strtoupper($_SESSION["ROLE"]);
                ?> }</li>
        </ul>
      </div>
    </div>
      <?php
    } else if ($_SESSION["ROLE"] == "member") {
      ?>
    
        <div class="custom-nav">
      <div class="custom-logo">
        <ul class="custom-lists">
          <li class="custom-list"><a class="custom-link" href="/quizapp/index.php">Quiz</a></li>
        </ul>
      </div>
      <div class="custom-menu">
        <ul class="custom-lists">
          <li class="custom-list"> <a class="custom-link" href="/quizapp/component/attempt.php">Attempt Quiz</a></li>
          <li class="custom-list"> <a class="custom-link" href="/quizapp/component/history.php">Quiz History</a></li>
          <li class="custom-list"> <a class="custom-link" href="/quizapp/component/logout.php">Logout</a></li>
          <li class="custom-list">{ <?php
                echo strtoupper($_SESSION["NAME"])." - ".strtoupper($_SESSION["ROLE"]);
                ?> }</li>
        </ul>
      </div>
    </div>
      <?php
    }

  } else {
    ?>
    <!-- <nav class="navbar navbar-expand-lg navbar-light bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand text-white" href="../index.php">QUIZ</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link text-white" href="/quizapp/component/loginpage.php">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="/quizapp/component/signuppage.php">SignUp</a>
            </li>
          </ul>
        </div>
      </div>
    </nav> -->

    <div class="custom-nav">
      <div class="custom-logo">
        <ul class="custom-lists">
          <li class="custom-list"><a class="custom-link" href="/quizapp/index.php">Quiz</a></li>
        </ul>
      </div>
      <div class="custom-menu">
        <ul class="custom-lists">
          <li class="custom-list"><a class="custom-link" href="/quizapp/component/loginpage.php">Login</a></li>
          <li class="custom-list"><a class="custom-link" href="/quizapp/component/signuppage.php">Signup</a></li>
        </ul>
      </div>
    </div>
    <?php
  }
  ?>

</body>

</html>
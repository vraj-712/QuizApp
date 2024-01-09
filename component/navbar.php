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
</head>

<body>
  <?php
  session_start();
  if (isset($_SESSION["ROLE"])) {
    if ($_SESSION["ROLE"] == "admin") {
      ?>
      <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand text-white" href="/quizapp/index.php">QUIZ</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

              <li class="nav-item ">
                <a class="nav-link text-white" href="/quizapp/component/Question.php">Add Questions</a>
              </li>
              <li class="nav-item ">
                <a class="nav-link text-white" href="/quizapp/component/attempt.php">Attempt Quiz</a>
              </li>
              <li class="nav-item ">
                <a class="nav-link text-white" href="/quizapp/component/history.php">Quiz History</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="/quizapp/component/logout.php">Logout</a>
              </li>
            </ul>
            <ul>
              <li class="nav-item text-white">
                <?php  
                echo $_SESSION["NAME"];
                ?>--
                <?php
                 echo $_SESSION["ROLE"]
                  ?>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <?php
    } else if ($_SESSION["ROLE"] == "member") {
      ?>
        <nav class="navbar navbar-expand-lg navbar-light bg-dark">
          <div class="container-fluid">
            <a class="navbar-brand text-white" href="../index.php">QUIZ</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item ">
                  <a class="nav-link text-white" href="/quizapp/component/attempt.php">Attempt Quiz</a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link text-white" href="/quizapp/component/history.php">Quiz History</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white" href="/quizapp/component/logout.php">Logout</a>
                </li>
              </ul>
              <ul>
                <li class="nav-item text-white">
                <?php
                echo $_SESSION["NAME"];
                ?> -- 
                <?php
                echo $_SESSION["ROLE"];
                ?>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      <?php
    }

  } else {
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
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
    </nav>
    <?php
  }
  ?>

</body>

</html>
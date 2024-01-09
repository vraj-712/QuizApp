<?php
if(isset($_SESSION["ROLE"])){
  header("Location:/quizapp/index.php");
}
else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <title>Login Page</title>
</head>
<body>
    <?php
    include("navbar.php");
    ?>
  
    <div id="msg"></div>
    <h1 class="text-center mt-3">Login</h1>
    <div class="me-auto ms-auto container mt-5">
  <div class="mb-3">
    <label for="exampleInputUser1" class="form-label">UserName</label>
    <input type="text" class="form-control" id="exampleInputUser1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1">
  </div>
  <button type="submit" class="btn btn-primary" id="login-btn">Submit</button>

  </div>
  <script>
    $(document).ready(function()
    {$("#login-btn").on("click", function () {
                let uname = $("#exampleInputUser1").val();
                let password = $("#exampleInputPassword1").val();
                let email = $("#exampleInputEmail1").val();
                if(uname!="" || password!=""||email!="")
                {
                  $.ajax({
                      type: "POST",
                      url: "/quizapp/classes/AjaxRequestClass.php",
                      data: { User_name: uname, User_email: email, User_password: password,action:'checkUserAjax' },
                      success: function(response)
                      {
                          
                            $("#msg").html(response)
                            window.location.replace('/quizapp/index.php')
                      }
                  });
                }
                else
                {
                  alert("Fill All Field!")
                }
            })
    })
  </script>
</body>
</html>
<?php
}
?>
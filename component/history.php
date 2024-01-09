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
    <title>History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <style>

    </style>
</head>
<body>
    <?php
    include("navbar.php");
    ?>
    <?php
    if(isset($_SESSION["ROLE"]))
    {
        if($_SESSION["ROLE"])
        { 
            ?>
            <table class="table container mt-3 table-bordered w-75 table-center table-striped">
            <tbody id="innerHistory">
        
            </tbody>
            </table>
            <?php
        }
    }
    ?>
    
</body>
    <script>
        $(document).ready(function()
        {
            $.ajax({
                type: "GET",
                url: "/quizapp/classes/AjaxRequestClass.php",
                data:{action:'getHistoryAjax'},
                success: function (response) {
                    $("#innerHistory").html(response)
                    
                }
            });
        })
    </script>
</html>
<?php
}else {
    header("Location:/quizapp/component/loginpage.php",true);
}
?>
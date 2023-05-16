<?php
    session_start();

    if(!isset($_SESSION["login"]) || $_SESSION["login"] != true || $_SESSION["login"] != "admin") {
      header("Location: /");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
    
</body>
</html>
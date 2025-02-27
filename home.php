<?php
    session_start(); // Start the session

    if(!isset($_SESSION['username'])){
        header("Location: login.html"); // Redirect to login page if not logged in
        exit();
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>/*stylings*/
        body{
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        form{
            
            display: flex;
            flex-direction: column;
            width: 400px;
            gap: 20px;
        }
        form input{
            padding-left: 20px;
            font-weight: bold;
            font-size: 22px;
            height: 45px;
            background-color: aliceblue;
            border-radius: 10px;
        }
        button{
            height: 38px;
            font-weight: bold;
            font-size: 20px;
            background-color: purple;
            width: 55%;
            align-self: center;
        }
    </style>
</head>
<body>
    <form action="login.php" method="post"><!--login form-->
        <input type="text" name="username" placeholder="email"><!--input fields-->
        <input type="password" name="password" placeholder="password">
        <button type="submit">Login</button><!--submit button for log in-->
    </form>
</body>
</html>

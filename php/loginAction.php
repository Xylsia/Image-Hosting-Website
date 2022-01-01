<?php

    if (isset($_POST['loginButton'])){
        include 'connect.php';

        $username = $_POST['username'];
        $password = $_POST['password'];

        if(empty($username) || empty($password)){
            header("Location: login.php?error=empty");
            exit();
        }
        else{
            $sql = "SELECT * FROM `user` 
                    WHERE `user`.username =?";
            $statement = mysqli_stmt_init($object); 
            
            if(!mysqli_stmt_prepare($statement, $sql)){
                header("Location: login.php?error=sqlerror");
                exit();
            }
            else{
                mysqli_stmt_bind_param($statement, "s", $username);
                mysqli_stmt_execute($statement);
                $result = mysqli_stmt_get_result($statement);

                if($row = mysqli_fetch_assoc($result)){
                    $passwordCheck = password_verify($password, $row['password_hash']);

                    if($passwordCheck == false){
                        header("Location: login.php?error=wrongpassword");
                        exit();
                    }
                    else if($passwordCheck == true){
                        session_start();
                        $_SESSION['userId'] = $row['user_id'];
                        $_SESSION['usernameId'] = $row['username'];

                        if(!empty($_POST['checkbox'])){
                            setcookie('username', $username, time() + 86400, "/");
                            setcookie('password', $password, time() + 86400, "/");
                        }
                    }
                    else{
                        header("Location: login.php?error=wrongpassword");
                        exit();
                    }
                }
                else{
                    header("Location: login.php?error=nouser");
                    exit();
                }

            }
        }
    }
    else{
        header("Location: login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Welcome</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>

    <body>
        <div class="bodyPhp">

            <img class="middleImg" src="../img/bg1.jpg"/>

            <?php
                echo "<p class=\"titlePhp\"> Welcome Back " . $_SESSION["usernameId"] . " !</p>";
                $object->close();
            ?>

            <form>
                <button id="buttonPhp" type="submit" formaction="faq.php">Return to Site</button><br/><br/>
            </form>
        </div>
    </body>
</html>
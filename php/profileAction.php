<?php
    if(isset($_POST['buttonChangeEmail'])){
        session_start();
        include 'connect.php';

        $user = $_SESSION['usernameId'];
        $email = $_POST['email'];

        if(empty($email)){
            header("Location: profile.php?error=empty&email");
            exit();
        }
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            header("Location: profile.php?error=invalid&email");
            exit();
        }
        else{
            $sql = "UPDATE `user` SET email = '$email' WHERE `user`.username = '$user'";
            $result = $object->query($sql);

            header("Location: profile.php?status=success");
            exit();
        }    
    }

    if(isset($_POST['buttonChangeDisplayName'])){
        session_start();
        include 'connect.php';

        $user = $_SESSION['usernameId'];
        $displayName = $_POST['displayName'];

        if(empty($displayName)){
            header("Location: profile.php?error=empty&displayName");
            exit();
        }
        else if(!preg_match("/^[a-zA-Z0-9-_.]{5,18}$/", $displayName)){
            header("Location: profile.php?error=invalid&displayName");
            exit();
        }
        else{
            $sql = "UPDATE `user` SET display_name = '$displayName' WHERE `user`.username = '$user'";
            $result = $object->query($sql);

            header("Location: profile.php?status=success");
            exit();
        }    
    }

    if(isset($_POST['buttonChangePassword'])){
        session_start();
        include 'connect.php';

        $user = $_SESSION['usernameId'];
        $password = $_POST['password'];

        if(empty($password)){
            header("Location: profile.php?error=empty&password");
            exit();
        }
        else if(!preg_match("/^[a-zA-Z0-9-_.]{5,18}$/", $password)){
            header("Location: profile.php?error=invalid&password");
            exit();
        }
        else{
            $sql = "UPDATE `user` SET password_hash = '$password' WHERE `user`.username = '$user'";
            $result = $object->query($sql);

            header("Location: profile.php?status=success");
            exit();
        }    
    }

    if(isset($_POST['buttonDeleteAccount'])){
        session_start();
        include 'connect.php';

        $user = $_SESSION['userId'];

        $sql = "DELETE `user`, `contact`, `picture`, `favorite`, `rating` FROM `user`
        INNER JOIN `contact` ON
        `user`.`user_id` = `contact`.`user_id`
        INNER JOIN `picture` ON
        `user`.`user_id` = `picture`.`user_id`
        INNER JOIN `favorite` ON
        `user`.`user_id` = `favorite`.`user_id`
        INNER JOIN `rating` ON
        `user`.`user_id` = `rating`.`user_id`
        WHERE `user`.`user_id` = '$user';";
        
        $result = $object->query($sql);
        session_unset();
        session_destroy();
        header("Location: faq.php");
    }
    $object->close();
?>
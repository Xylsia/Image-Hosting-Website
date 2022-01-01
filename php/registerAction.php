<?php
    if(isset($_POST['registerButton'])){
        include 'connect.php';

        $username = $_POST['username'];
        $password = $_POST['password'];
        $passwordConfirm = $_POST['passwordConfirm'];
        $email = $_POST['email'];
        $displayName = $_POST['displayName'];

        if(empty($username) || empty($password) || empty($passwordConfirm) || empty($email) || empty($displayName)){
            header("Location: register.php?error=empty&username=".$username."&password=".$password."&passwordConfirm=".$passwordConfirm."&email=".$email."&displayName=".$displayName);
            exit();
        }
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            header("Location: register.php?error=invalidemail&email=".$email);
            exit();
        }
        else if(!preg_match("/^[a-zA-Z0-9-_.]{5,18}$/", $username)){
            header("Location: register.php?error=invalidusername&username=".$username);
            exit();
        }
        else if(!preg_match("/^[a-zA-Z0-9-_.]{5,18}$/", $password)){
            header("Location: register.php?error=invalidpassword");
            exit();
        }
        else if(!preg_match("/^[a-zA-Z0-9-_.]{5,18}$/", $displayName)){
            header("Location: register.php?error=invaliddisplayname&displayName=".$displayName);
            exit();
        }
        else if($password !== $passwordConfirm){
            header("Location: register.php?error=passwordcheck");
            exit();
        }
        else{
            $sql = "SELECT `user`.username, `user`.email
                    FROM `user`
                    WHERE `user`.username =? OR `user`.email =?";
            $statement = mysqli_stmt_init($object);
            if(!mysqli_stmt_prepare($statement, $sql)){
                header("Location: register.php?error=sqlerror");
                exit();
            }
            else{
                mysqli_stmt_bind_param($statement, "ss", $username, $email);
                mysqli_stmt_execute($statement);
                mysqli_stmt_store_result($statement);
                $resultCheck = mysqli_stmt_num_rows($statement);
                if($resultCheck > 0){
                    header("Location: register.php?error=usertaken");
                    exit();
                }
                else{
                    $sql = "INSERT INTO `user` (username, password_hash, email, display_name) VALUES (?, ?, ?, ?)";
                    $statement = mysqli_stmt_init($object);
                    if(!mysqli_stmt_prepare($statement, $sql)){
                        header("Location: register.php?error=sqlerror");
                        exit();
                    }
                    else{
                        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                        mysqli_stmt_bind_param($statement, "ssss", $username, $passwordHash, $email, $displayName);
                        mysqli_stmt_execute($statement);
                    }
                }
            } 
        }
        $statement->close();
    }
    else{
        header("Location: ../register.php");
        exit();
    }

    class Account{
        public $username, $password, $email, $displayName;

        function __construct($username, $password, $email, $displayName){
            $this->username = $username;
            $this->password = $password;
            $this->email = $email;
            $this->displayName = $displayName;
        }

        public function __toString(){
            try{
                return (string) "<p class=\"textPhp\">Username:</p> <p class=\"varPhp\">" . $this->username . "</p><br />" .
                                "<p class=\"textPhp\">Password:</p> <p class=\"varPhp\">" . $this->password . "</p><br />" .
                                "<p class=\"textPhp\">Email:</p> <p class=\"varPhp\">" . $this->email . "</p><br />" .
                                "<p class=\"textPhp\">Display Name:</p> <p class=\"varPhp\">" . $this->displayName . "</p><br />" .
                                "<p class=\"textPhp\">Date Created:</p> <p class=\"varPhp\">" . date("Y/m/d") . "</p><br />";
            }
            catch(Exception $exception){
                return "";
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Thank You!</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>

    <body>
        <div class="bodyPhp">

            <img class="middleImg" src="../img/bg2.png"/>

            <?php
                $user = new Account($username, $password, $email, $displayName);
                echo "<p class=\"titlePhp\"> Thank you for joining Truwupapers! Welcome aboard! <br /> Your parameters are: </p>";
                echo $user;

                $object->close();
            ?>

            <form>
                <button id="buttonPhp" type="submit" formaction="faq.php">Return to Site</button><br/><br/>
            </form>
        </div>
    </body>
</html>


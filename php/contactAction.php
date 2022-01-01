<?php
    if(isset($_POST['contactButton'])){
        session_start();
        include 'connect.php';
        
        $user = $_SESSION['userId'];
        $title = $_POST['title'];
        $textArea = $_POST['textArea'];
        $date = date("Y-m-d H:i:s");

        if(empty($title) || empty($textArea)){
            header("Location: contact.php?error=empty");
            exit();
        }
        else if(!preg_match("/[\S][^\w\d.*]*/", $title)){
            header("Location: contact.php?error=invalid&title");
            exit();
        }
        else if(!preg_match("/[\S][^\w\d.*]*/", $textArea)){
            header("Location: contact.php?error=invalid&text");
            exit();
        }
        else{
            $sql = "INSERT INTO `contact` (`user_id`, `title`, `description`, `created_at`) VALUES ('".$user."', '".$title."', '".$textArea."', '".$date."')";
            $result = $object->query($sql);
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

            <img class="middleImg" src="../img/bg8.jpg"/>

            <?php
                echo "<p class=\"titlePhp\"> Thank you for contacting us " . $_SESSION["usernameId"] . " !</p><br/>";
                echo "<p class=\"textPhp\"> We will get back at you as soon as possible!</p><br/>";
                echo "<p class=\"textPhp\"> Ticket submission date and time: " . $date . "</p><br/>";
                $object->close();
            ?>

            <form>
                <button id="buttonPhp" type="submit" formaction="faq.php">Return to Site</button><br/><br/>
            </form>
        </div>
    </body>
</html>
<?php
    if(isset($_POST['uploadButton'])){
        session_start();
        include 'connect.php';

        $user = $_SESSION['userId'];
        $title = $_POST['title'];
        $date = date("Y-m-d H:i:s");

        $file = $_FILES['file'];

        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png');

        if(empty($title)){
            header("Location: upload.php?error=empty");
            exit();
        }
        else if(!preg_match("/[\S][^\w\d.*]*/", $title)){
            header("Location: upload.php?error=invalid&title");
            exit();
        }
        else{
            if(in_array($fileActualExt, $allowed)){
                if($fileError === 0){
                    if($fileSize < 1000000){
                        $fileNameNew = uniqid('', true).".".$fileActualExt;
                        $fileDestination = '../img/'.$fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);

                        $sql = "INSERT INTO `picture` (`user_id`, `title`, `path`, `created_at`) VALUES ('".$user."', '".$title."', '".$fileDestination."', '".$date."')";
                        $result = $object->query($sql);

                        $sql1 = "INSERT INTO `picture_tag` (`user_id`, `picture_id`) VALUES ('".$user."', 42)";
                        $result = $object->query($sql1);
                        $sql2 = "INSERT INTO `rating` (`user_id`, `picture_id`) VALUES ('".$user."', 42)";
                        $result = $object->query($sql2);
                        $sql3 = "INSERT INTO `favorite` (`user_id`, `picture_id`) VALUES ('".$user."', 42)";
                        $result = $object->query($sql3);


                        header("Location: upload.php?status=success");
                        exit();

                    }
                    else{
                        header("Location: upload.php?error=size");
                        exit();
                    }
                }
                else{
                    header("Location: upload.php?error=upload");
                    exit();
                }
            }
            else{
                header("Location: upload.php?error=type");
                exit();
            }
        }
    }
    $object->close();
?>
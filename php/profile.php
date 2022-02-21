<?php
  session_start();
  include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">

	<head>
		<title>Truwupapers</title>
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="mailto: jovana.krzanovic.18@singimail.rs, Jovana Kržanović">
		<meta name="description" content="download high quality wallpapers">
		<meta name="keywords" content="wallpaper, picture, high quality">

		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
		<link rel="shortcut icon" href="../img/icon.ico">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>

    <body>
        <header>
			<div class="headerTop">
				<nav class="headerNav">
                    <ul>
                    <?php 
                
                        if(isset($_SESSION['usernameId'])){
                                echo "<li><a href=\"index.php\">Home</a></li>
                                <li><a href=\"browse.php?sort=browse\">Browse</a></li>
                                <li><a href=\"upload.php\">Upload</a></li>
                                <li><a class=\"active\" href=\"profile.php\">Profile</a></li>
                                <li><a href=\"logoutAction.php\">Logout</a></li>";
                        }
                        else{
                            echo "<li><a class=\"active\" href=\"index.php\">Home</a></li>
                            <li><a href=\"browse.php?sort=browse\">Browse</a></li>
                            <li><a href=\"upload.php\">Upload</a></li>
                            <li><a href=\"login.php\">Login</a></li>
                            <li><a href=\"register.php\">Register</a></li>";
                        }
                    ?>
                    </ul>
				</nav>
			</div>
			<div class="headerMid">
				<h1 class="title"><a href="index.php">Truwupapers</a></h1>
			</div>
			<div class="headerBot">
                <form class="search" name="searchForm" method="GET" action="search.php">
                    <input type="text" class="searchText" placeholder="Search..." name="search" size="50">
                    <button type="submit" name="searchButton" class="searchButton"><i class="fa fa-search"></i></button>
                </form>
			</div>
		</header>	

        <?php
            $user = $_SESSION['usernameId'];
            echo "<div class=\"profileBody\">";
                echo "<h2 class=\"profileTitle\">" . $user . "'s Profile Page</h2><br/>";
                echo "<hr><br/>";
                echo "<h3 class=\"profileSubTitle\">Current Parametres: </h3><br/>";
                $sql = "SELECT * FROM `user` WHERE `user`.username = '$user'";
                $result = $object->query($sql);
                if ($result->num_rows > 0){
                    while ($row = $result->fetch_assoc()){
                        echo "<h4 class=\"profileText\">user id:&nbsp;". $row['user_id'] ."</h4><br/>";
                        echo "<h4 class=\"profileText\">username:&nbsp;". $row['username'] ."</h4><br/>";
                        echo "<h4 class=\"profileText\">email:&nbsp;". $row['email'] ."</h4><br/>";
                        echo "<h4 class=\"profileText\">display name:&nbsp;". $row['display_name'] ."</h4><br/><br/>";

                    }
                }

                echo "<h3 class=\"profileSubTitle\">Change email: </h3>";
                echo "<form method=\"POST\" action=\"profileAction.php\">";
                    echo "<input type=\"text\" id=\"email\" name=\"email\" placeholder=\"Enter your email\" size=\"40\"/>&nbsp&nbsp&nbsp";
                    echo "<button type=\"submit\" id=\"buttonChangeEmail\" name=\"buttonChangeEmail\">Change</button>";
                echo "</form><br/><br/>";
                echo "<h3 class=\"profileSubTitle\">Change Display Name: </h3>";
                echo "<form method=\"POST\" action=\"profileAction.php\">";
                    echo "<input type=\"text\" id=\"displayName\" name=\"displayName\" placeholder=\"Enter your Display Name\" size=\"40\"/>&nbsp&nbsp&nbsp";
                    echo "<button type=\"submit\" id=\"buttonChangeDisplayName\" name=\"buttonChangeDisplayName\">Change</button>";
                echo "</form><br/><br/>";

                echo "<h3 class=\"profileSubTitle\">Change Password: </h3>";
                echo "<form method=\"POST\" action=\"profileAction.php\">";
                    echo "<input type=\"password\" id=\"password\" name=\"password\" placeholder=\"Enter your password\" size=\"40\"/>&nbsp&nbsp&nbsp";
                    echo "<button type=\"submit\" id=\"buttonChangePassword\" name=\"buttonChangePassword\">Change</button>";
                echo "</form><br/><br/>";

                echo "<h3 class=\"profileSubTitle\">Delete your account: </h3>";
                echo "<form method=\"POST\" action=\"profileAction.php\">";
                    echo "<button type=\"submit\" id=\"buttonDeleteAccount\" name=\"buttonDeleteAccount\">Delete</button>";
                echo "</form>";

                if(isset($_GET['error'])){
                    if($_GET['error'] == "empty"){
                        echo "<p class=\"error\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;empty input!</p>";
                    }
                    else if($_GET['error'] == "invalid"){
                        echo "<p class=\"error\"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;invalid input!</p>";
                    }
                }
                else if(isset($_GET['status'])){
                    if($_GET['status'] == "success"){
                        echo "<p class=\"success\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;update is successful!</p>";
                    }
                }

                $user = $_SESSION['userId'];

                $myFile = "contacts$user.txt";
                $fo = fopen($myFile, 'w+') or die('Cannot open file');
            
                $sql = "SELECT * FROM contact WHERE `user_id` = '$user'";
                $result = $object->query($sql);
                echo "</br></br></br></br></br><h3 class=\"profileSubTitle\">Opened Tickets: </h3><br/>";
                if ($result->num_rows > 0){
                    while ($row = $result->fetch_assoc()){
                        $data = "<h4 class=\"profileText\">Title: " . $row['title'] . "</br>Date: " . $row['created_at'] . "</h4></br></br>";
            
                        fwrite($fo, $data);
                    }
                }
                echo file_get_contents($myFile);
                fclose($fo);

            echo "</br></br></div>";
            $object->close();
        ?>                

		<footer>
            <div class="footerTop">
				<nav class="footerNav">
                    <ul>
					    <li><a href="terms.php">Terms of Service</a></li>
					    <li><a href="privacy.php">Privacy Policy</a></li>
                        <li><a href="cookies.php">Cookies</a></li>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="faq.php">FAQ</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
                    </ul>
				</nav>
            </div>
            <div class="footerMid">
                <a href="https://www.facebook.com " target="_blank" alt="Facebook"><span class="fab fa-facebook-square fa-2x"></span></a>
                <a href="https://twitter.com" target="_blank" alt="Twitter"><span class="fab fa-twitter-square fa-2x"></span></a>
                <a href="https://www.pinterest.com" target="_blank" alt="Pinterest"><span class="fab fa-pinterest-square fa-2x"></span></a>
                <a href="https://www.tumblr.com" target="_blank" alt="Tumblr"><span class="fab fa-tumblr-square fa-2x"></span></a>
                <a href="https://discordapp.com" target="_blank" alt="Discord"><span class="fab fa-discord fa-2x"></span></a>
                <a href="https://www.deviantart.com" target="_blank" alt="DeviantArt"><span class="fab fa-deviantart fa-2x"></span></a>
            </div>
            <div class="footerBot">
                <p class="copyright"><small>&copy; 2020 &hearts; <a href="https://singidunum.ac.rs" target="_blank">Singidunum</a> &hearts; <a href="index.php">Truwupapers</a> &hearts;</small></p>
            </div>    
		</footer>
        <script type="text/javascript" src="../js/slideshow.js"></script>
    </body>

</html>
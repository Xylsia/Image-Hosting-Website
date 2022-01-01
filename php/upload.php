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
                                <li><a class=\"active\" href=\"upload.php\">Upload</a></li>
                                <li><a href=\"profile.php\">Profile</a></li>
                                <li><a href=\"logoutAction.php\">Logout</a></li>";
                        }
                        else{
                            echo "<li><a href=\"index.php\">Home</a></li>
                            <li><a href=\"browse.php?sort=browse\">Browse</a></li>
                            <li><a class=\"active\" href=\"upload.php\">Upload</a></li>
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
		
		<div class="middle">
            <img class="middleImg" src="../img/bg4.jpg">
            <h2 class="question">Upload</h2>

            <?php
                if(isset($_GET['error'])){
                    if($_GET['error'] == "empty"){
                        echo "<p class=\"error\">empty input!</p>";
                    }
                    else if($_GET['error'] == "invalid"){
                        echo "<p class=\"error\">invalid input!</p>";
                    }
                    else if($_GET['error'] == "size"){
                        echo "<p class=\"error\">file too big!</p>";
                    }
                    else if($_GET['error'] == "upload"){
                        echo "<p class=\"error\">error occured!</p>";
                    }
                    else if($_GET['error'] == "type"){
                        echo "<p class=\"error\">jpg, jpeg, png allowed!</p>";
                    }
                }
                else if(isset($_GET['status'])){
                    if($_GET['status'] == "success"){
                        echo "<p class=\"success\">upload successful!</p>";
                    }
                }
            ?>

            <form class="form" method="POST" action="uploadAction.php" enctype="multipart/form-data">
                <label class="label">Select Image to Upload:</label><br /><br /><input type="file" name="file" id="upload"><span id="uploadSpan"></span><br /><br />
                <label class="label">Title:</label><br /><input type="text" id="title" name="title" placeholder="Enter title" size="50"/><span id="titleSpan"></span><br /><br/>
                <?php 
                    if(isset($_SESSION['usernameId'])){
                        echo "<button type=\"submit\" id=\"uploadButton\" name=\"uploadButton\">Upload Image</button><br /><br /><br />";
                    }
                    else{
                        echo "<p class=\"loginWarning\">You need to be logged in!</p><br /><br /><br />";
                    }
                    $object->close();
                ?>
            </form>
		</div>

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
                <p class="copyright"><small>&copy; 2020 &hearts; <a href="https://singidunum.ac.rs" target="_blank">Singidunum</a> &hearts; <a href="index.php">Truwupapers</a> &hearts; Jovana Kržanović 2018200030 &hearts; </small></p>
            </div>    
		</footer>
		<script type="text/javascript" src="../js/upload.js"></script>
    </body>

</html>
<?php
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
                        <li><a href="index.php">Home</a></li>
                        <li><a href="browse.php?sort=browse">Browse</a></li>
                        <li><a href="upload.php">Upload</a></li>
					    <li><a class="active" href="login.php">Login</a></li>
                        <li><a href="register.php">Register</a></li>
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
            <img class="middleImg" src="../img/bg7.jpg">
            <h2 class="question">Sign In</h2>
            <?php
                if(isset($_GET['error'])){
                    if($_GET['error'] == "empty"){
                        echo "<p class=\"error\">Fill in all fields!</p>";
                    }
                    else if($_GET['error'] == "wrongpassword"){
                        echo "<p class=\"error\">Wrong username/password!</p>";
                    }
                    else if($_GET['error'] == "nouser"){
                        echo "<p class=\"error\">User doesn't exist!</p>";
                    }
                }
                $object->close();
            ?>
            <form class="form" method="POST" action="loginAction.php">
                <label class="label">Username:</label><br /><input type="text" id="username" name="username" placeholder="Enter username" size="50" <?php if(isset($_COOKIE['username'])){ echo "value='{$_COOKIE['username']}'"; } ?> /><span id="usernameSpan"></span><br />
                <label class="label">Password:</label><br /><input type="password" id="password" name="password" placeholder="Enter password" size="50" <?php if(isset($_COOKIE['password'])){ echo "value='{$_COOKIE['password']}'"; } ?>/><span id="passwordSpan"></span><br /><br/>
                <input type="checkbox" name="checkbox"><label class="labelChoice">&nbsp;Remember me</label><br/><br/>
                <button type="submit" id="loginButton" name="loginButton">Login</button><br /><br /><br />
                <label class="label">Don't have an account?</label><br /><button type="submit" formaction="register.php" id="regButton">Register Here</button><br /><br />
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
                <p class="copyright"><small>&copy; 2020 &hearts; <a href="https://singidunum.ac.rs" target="_blank">Singidunum</a> &hearts; <a href="index.php">Truwupapers</a> &hearts;</small></p>
            </div>    
		</footer>
		<script type="text/javascript" src="../js/login.js"></script>
    </body>

</html>
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
					    <li><a href="login.php">Login</a></li>
                        <li><a class="active" href="register.php">Register</a></li>
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
            <img class="middleImg" src="../img/bg6.jpg">
            <h2 class="question">Sign Up</h2>
            <?php
                if(isset($_GET['error'])){
                    if($_GET['error'] == "empty"){
                        echo "<p class=\"error\">Fill in all fields!</p>";
                    }
                    else if($_GET['error'] == "invalidusername"){
                        echo "<p class=\"error\">Username is invalid!</p>";
                    }
                    else if($_GET['error'] == "invalidemail"){
                        echo "<p class=\"error\">email is invalid!</p>";
                    }
                    else if($_GET['error'] == "invalidpassword"){
                        echo "<p class=\"error\">password is invalid!</p>";
                    }
                    else if($_GET['error'] == "invaliddisplayname"){
                        echo "<p class=\"error\">Display Name is invalid!</p>";
                    }
                    else if($_GET['error'] == "passwordcheck"){
                        echo "<p class=\"error\">Passwords do not match!</p>";
                    }
                    else if($_GET['error'] == "usertaken"){
                        echo "<p class=\"error\">Username is taken!</p>";
                    }
                }
            ?>
            <form class="form" method="POST" action="registerAction.php">
                <label class="label">Username:</label><br /><input type="text" id="username" name="username" placeholder="Enter username" size="50"/><span id="usernameSpan"></span><br />
                <label class="label">Password:</label><br /><input type="password" id="password" name="password" placeholder="Enter password" size="50"/><span id="passwordSpan"></span><br />
                <label class="label">Confirm Password:</label><br /><input type="password" id="passwordConfirm" name="passwordConfirm" placeholder="Confirm password" size="50"/><span id="passwordConfirmSpan"></span><br />
                <label class="label">Email:</label><br /><input type="text" id="email" name="email" placeholder="Enter email" size="50"/><span id="emailSpan"></span><br />
                <label class="label">Display Name:</label><br /><input type="text" id="displayName" name="displayName" placeholder="Enter display name" size="50"/><span id="displayNameSpan"></span><br />
                <button type="submit" id="registerButton" name="registerButton">Register</button><br /><br /><br />
                <label class="label">Already have an account?</label><br /><button type="submit" formaction="login.php" id="logButton">Login Here</button><br /><br />
                <p style="color:#591b98;">By creating an account you agree to our <a href="terms.php" target="_blank">Terms or Service</a> & <a href="privacy.php" target="_blank">Privacy Policy.</a></p>
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
		<script type="text/javascript" src="../js/register.js"></script>
    </body>

</html>
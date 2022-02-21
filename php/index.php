<?php
  session_start();
  include 'connect.php';
  include 'database.php';
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
                                echo "<li><a class=\"active\" href=\"index.php\">Home</a></li>
                                <li><a href=\"browse.php?sort=browse\">Browse</a></li>
                                <li><a href=\"upload.php\">Upload</a></li>
                                <li><a href=\"profile.php\">Profile</a></li>
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

            <a href="browse.php?sort=browse"><img class="slideshow" src="../img/slide1.jpg" ></a>

            <?php

                echo "<div class=\"indexMiddle\">";
                    echo "<div class=\"indexTitle\"><br/><h2>"; ?> <a href="browse.php?sort=ratingDESC">Highest Rated</a> <?php echo "</h2></div>";
                    $sql = "SELECT picture.path, picture.title, AVG(rating.rate) AS average, picture.picture_id
                            FROM picture
                            INNER JOIN rating ON
                            picture.picture_id = rating.picture_id
                            GROUP BY picture.title
                            ORDER BY average DESC
                            LIMIT 8;";
                    $result = $object->query($sql);
                    echo "<div class=\"results\">";
                    if ($result->num_rows > 0){
                        while ($row = $result->fetch_assoc()){
                            echo "<div class=\"result\">";
                            echo "<div class=\"resultImg\">"; ?>  <a href="picture.php?id=<?php echo $row['picture_id']?>"> <img class="img" src="<?php echo $row['path']; ?>"> </a> <?php echo "</div>"; ?>
                            <?php echo "<div class=\"resultText\"><h3>" . $row['title'] . "</h3></div>";
                            echo "<div class=\"resultRating\"><h4>" . $row['average'] . "</h4></div></div>";
                    }
                    echo "</div><br/><br/><br/>";
                }
                echo "</div>";     

                echo "<div class=\"indexMiddle\">";
                    echo "<div class=\"indexTitle\"><br/><h2>"; ?> <a href="browse.php?sort=newestDESC">Recently Added</a> <?php echo "</h2></div>";
                    $sql = "SELECT picture.path, picture.title, picture.created_at AS datte, picture.picture_id
                            FROM picture
                            GROUP BY picture.title
                            ORDER BY picture.created_at DESC
                            LIMIT 8;";
                    $result = $object->query($sql);
                    echo "<div class=\"results\">";
                    if ($result->num_rows > 0){
                        while ($row = $result->fetch_assoc()){
                            echo "<div class=\"result\">";
                            echo "<div class=\"resultImg\">"; ?>  <a href="picture.php?id=<?php echo $row['picture_id']?>"> <img class="img" src="<?php echo $row['path']; ?>"> </a> <?php echo "</div>"; ?>
                            <?php echo "<div class=\"resultText\"><h3>" . $row['title'] . "</h3></div>";
                            echo "<div class=\"resultText\"><h4>" . $row['datte'] . "</h4></div></div>";
                    }
                    echo "</div><br/><br/><br/>";
                }
                echo "</div>";
                
                echo "<div class=\"indexMiddle\">";
                    echo "<div class=\"indexTitle\"><br/><h2>"; ?> <a href="browse.php?sort=browse">Most Favorites</a> <?php echo "</h2></div>";
                    $sql = "SELECT picture.title, picture.path, picture.picture_id, COUNT(favorite.favorite_id) AS favorites
                        FROM picture INNER JOIN favorite ON
                        picture.picture_id = favorite.picture_id
                        GROUP BY picture.title
                        ORDER BY favorites DESC
                        LIMIT 8;";
                    $result = $object->query($sql);
                    echo "<div class=\"results\">";
                    if ($result->num_rows > 0){
                        while ($row = $result->fetch_assoc()){
                            echo "<div class=\"result\">";
                            echo "<div class=\"resultImg\">"; ?>  <a href="picture.php?id=<?php echo $row['picture_id']?>"> <img class="img" src="<?php echo $row['path']; ?>"> </a> <?php echo "</div>"; ?>
                            <?php echo "<div class=\"resultText\"><h3>" . $row['title'] . "</h3></div>";
                            echo "<div class=\"resultText\"><h4>" . $row['favorites'] . "</h4></div></div>";
                    }
                    echo "</div><br/><br/><br/>";
                }
                echo "</div>"; 
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
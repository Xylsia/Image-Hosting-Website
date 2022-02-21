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
                                <li><a href=\"profile.php\">Profile</a></li>
                                <li><a href=\"logoutAction.php\">Logout</a></li>";
                        }
                        else{
                            echo "<li><a href=\"index.php\">Home</a></li>
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
		    echo "<div class=\"picturePage\">";
            
            if(isset($_GET['id'])){
                $id = $object->real_escape_string($_GET['id']);

                $sql = "SELECT * FROM picture WHERE picture.picture_id = '$id'";
                $result = $object->query($sql);
                $row = $result->fetch_array();
                echo "<div class=\"picture\">"; ?> <img class="img" src="<?php echo $row['path']; ?>"> <?php echo "</div>";
                echo "<div class=\"pictureText\" ><h3>Title: </h3></div>";
                echo "<div class=\"pictureText\" id=\"pictureText1\"><h4>" . $row['title'] . "</h4></div>";
                echo "<div class=\"pictureText\"><h3>Date Added: </h3></div>";
                echo "<div class=\"pictureText\" id=\"pictureText1\"><h4>" . $row['created_at'] . "</h4></div>";
                
                $sql="SELECT picture.picture_id, `user`.display_name AS userr
                        FROM picture INNER JOIN `user` ON
                        picture.user_id = user.user_id
                        WHERE picture.picture_id  = '$id'
                        GROUP BY picture.title;";
                $result = $object->query($sql);
                $row = $result->fetch_array(); 
                echo "<div class=\"pictureText\"><h3>Uploaded By: </h3></div>";
                echo "<div class=\"pictureText\" id=\"pictureText1\"><h4>" . $row['userr'] . "</h4></div>";       

                $sql = "SELECT picture.picture_id, tag.`name` AS tag_name
                        FROM picture
                        INNER JOIN picture_tag ON
                        picture.picture_id = picture_tag.picture_id
                        INNER JOIN tag ON
                        picture_tag.tag_id = tag.tag_id
                        WHERE picture.picture_id  = '$id'
                        GROUP BY picture_tag_id
                        ORDER BY picture.title;";
                $result = $object->query($sql);
                echo "<div class=\"pictureText\"><h3>Tag(s):</h3></div>";
                 if ($result->num_rows > 0){
                    while ($row = $result->fetch_assoc()){
                        echo "<div class=\"pictureText\" id=\"pictureText1\"><h4>" . $row['tag_name'] . "</h4></div>";
                    }
                } 
                
                $sql = "SELECT AVG(rating.rate) AS average, picture.picture_id
                        FROM picture INNER JOIN rating ON
                        picture.picture_id = rating.picture_id
                        WHERE picture.picture_id  = '$id'
                        GROUP BY picture.title;";
                $result = $object->query($sql);
                $row = $result->fetch_array();
                echo "<div class=\"pictureText\"><h3>Rating:</h3></div>";
                echo "<div class=\"pictureText\" id=\"pictureText1\"><h4>" . $row['average'] . "</h4></div>";
                        
                $sql = "SELECT COUNT(favorite.favorite_id) AS favorites
                        FROM picture INNER JOIN favorite ON
                        picture.picture_id = favorite.picture_id
                        WHERE picture.picture_id  = '$id'
                        GROUP BY picture.title;";
                $result = $object->query($sql);
                $row = $result->fetch_array();
                echo "<div class=\"pictureText\"><h3>Favorites:</h3></div>";
                echo "<div class=\"pictureText\" id=\"pictureText1\"><h4>" . $row['favorites'] . "</h4></div><br/><br/>";
                echo "<div class=\"pictureText\"><h4> You can download image by Right Click (on the image) -> Save Image As</h4></div></br>";
                
                if(isset($_SESSION['usernameId'])){
                    echo "<form action=\"#\" method=\"POST\">";
                        echo "<label class=\"label\">Rate picture</label><br/>";
                        echo "<input type=\"radio\" class=\"radio\" name=\"radio\" value=\"1\" ><label class=\"labelChoice\">1 star</label>";
                        echo "<input type=\"radio\" class=\"radio\" name=\"radio\" value=\"2\" ><label class=\"labelChoice\">2 star</label>";
                        echo "<input type=\"radio\" class=\"radio\" name=\"radio\" value=\"3\" ><label class=\"labelChoice\">3 star</label>";
                        echo "<input type=\"radio\" class=\"radio\" name=\"radio\" value=\"4\" ><label class=\"labelChoice\">4 star</label>";
                        echo "<input type=\"radio\" class=\"radio\" name=\"radio\" value=\"5\" ><label class=\"labelChoice\">5 star</label><br/>";
                        echo "<button type=\"submit\" id=\"buttonRating\">Rate</button>";
                    echo "</form><br/>";

                    echo "<form action=\"#\" method=\"POST\">";
                        echo "<label class=\"label\">Add picture to favorites</label><br/>";
                        echo "<button type=\"submit\" id=\"buttonFavorite\">Favorite</button>";
                    echo "</form>";
                }   
                else{
                    echo "<p class=\"loginWarning\">You need to be logged in!</p><br /><br /><br />";
                }  
            }

            echo "<br/></div>";
            
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
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
                                <li><a class=\"active\" href=\"browse.php?sort=browse\">Browse</a></li>
                                <li><a href=\"upload.php\">Upload</a></li>
                                <li><a href=\"profile.php\">Profile</a></li>
                                <li><a href=\"logoutAction.php\">Logout</a></li>";
                        }
                        else{
                            echo "<li><a href=\"index.php\">Home</a></li>
                            <li><a class=\"active\" href=\"browse.php?sort=browse\">Browse</a></li>
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
            echo "<div class=\"resultBrowse\">";
                echo "<div class=\"resultText\"><h2>Categories</h2></div><br/>";
                echo "<nav class=\"resultNav1\"><ul>"; 
                        echo "<li>"; ?> <a href="browse.php?sort=animal">Animal</a> <?php echo "</li>";
                        echo "<li>"; ?> <a href="browse.php?sort=anime">Anime</a> <?php echo "</li>";
                        echo "<li>"; ?> <a href="browse.php?sort=abstract">Abstract</a> <?php echo "</li>";
                        echo "<li>"; ?> <a href="browse.php?sort=vehicle">Vehicle</a> <?php echo "</li>";
                        echo "<li>"; ?> <a href="browse.php?sort=civilization">Civilization</a> <?php echo "</li>";
                        echo "<li>"; ?> <a href="browse.php?sort=fantasy">Fantasy</a> <?php echo "</li>";
                        echo "<li>"; ?> <a href="browse.php?sort=video game">Video Game</a> <?php echo "</li>";
                        echo "<li>"; ?> <a href="browse.php?sort=nature">Nature</a> <?php echo "</li>";
                        echo "<li>"; ?> <a href="browse.php?sort=music">Music</a> <?php echo "</li>";
                        echo "<li>"; ?> <a href="browse.php?sort=sport">Sport</a> <?php echo "</li>";
                        echo "<li>"; ?> <a href="browse.php?sort=equipment">Equpment</a> <?php echo "</li>";
                        echo "<li>"; ?> <a href="browse.php?sort=brand">Brand</a> <?php echo "</li>";
                        echo "<li>"; ?> <a href="browse.php?sort=food">Food</a> <?php echo "</li>";
                        echo "<li>"; ?> <a href="browse.php?sort=science">Science</a> <?php echo "</li>";
                        echo "<li>"; ?> <a href="browse.php?sort=science fiction">Science Fiction</a> <?php echo "</li>";

                echo "</ul></nav><br/>";
                echo "<div class=\"resultText\"><h2>Sort By</h2></div><br/>";
                echo "<nav class=\"resultNav2\"><ul><li>" ?> <a href="browse.php?sort=newestASC">Upload Date ASC</a> <?php echo "</li>
                                                    <li>" ?> <a href="browse.php?sort=newestDESC">Upload Date DESC</a> <?php echo "</li>
                                                    <li>" ?> <a href="browse.php?sort=ratingASC">Rating ASC</a> <?php echo "</li>
                                                    <li>" ?> <a href="browse.php?sort=ratingDESC">Rating DESC</a> <?php echo "</li>
                                                    <li>" ?> <a href="browse.php?sort=alphabeticalASC">Alphabetical ASC</a> <?php echo "</li>
                                                    <li>" ?> <a href="browse.php?sort=alphabeticalDESC">Alphabetical DESC</a> <?php echo "</li>";
                echo "</ul></nav>";                                   
            echo "</br></div>";


            if($_GET['sort'] == 'animal'){
                $sql = "SELECT picture.path, picture.title, picture.picture_id, picture.created_at AS datte, AVG(rating.rate) AS average, tag.`name`
                        FROM picture
                        INNER JOIN picture_tag ON
                        picture.picture_id = picture_tag.picture_id
                        INNER JOIN tag ON
                        picture_tag.tag_id = tag.tag_id
                        INNER JOIN rating ON
                        picture.picture_id = rating.picture_id
                        WHERE tag.`name` = 'animal'
                        GROUP BY picture_tag_id
                        ORDER BY picture.title;";
            }
            elseif($_GET['sort'] == 'anime'){
                $sql = "SELECT picture.path, picture.title, picture.picture_id, picture.created_at AS datte, AVG(rating.rate) AS average, tag.`name`
                        FROM picture
                        INNER JOIN picture_tag ON
                        picture.picture_id = picture_tag.picture_id
                        INNER JOIN tag ON
                        picture_tag.tag_id = tag.tag_id
                        INNER JOIN rating ON
                        picture.picture_id = rating.picture_id
                        WHERE tag.`name` = 'anime'
                        GROUP BY picture_tag_id
                        ORDER BY picture.title;";
            }
            elseif($_GET['sort'] == 'abstract'){
                $sql = "SELECT picture.path, picture.title, picture.picture_id, picture.created_at AS datte, AVG(rating.rate) AS average, tag.`name`
                        FROM picture
                        INNER JOIN picture_tag ON
                        picture.picture_id = picture_tag.picture_id
                        INNER JOIN tag ON
                        picture_tag.tag_id = tag.tag_id
                        INNER JOIN rating ON
                        picture.picture_id = rating.picture_id
                        WHERE tag.`name` = 'abstract'
                        GROUP BY picture_tag_id
                        ORDER BY picture.title;";
            }
            elseif($_GET['sort'] == 'vehicle'){
                $sql = "SELECT picture.path, picture.title, picture.picture_id, picture.created_at AS datte, AVG(rating.rate) AS average, tag.`name`
                        FROM picture
                        INNER JOIN picture_tag ON
                        picture.picture_id = picture_tag.picture_id
                        INNER JOIN tag ON
                        picture_tag.tag_id = tag.tag_id
                        INNER JOIN rating ON
                        picture.picture_id = rating.picture_id
                        WHERE tag.`name` = 'vehicle'
                        GROUP BY picture_tag_id
                        ORDER BY picture.title;";
            }
            elseif($_GET['sort'] == 'civilization'){
                $sql = "SELECT picture.path, picture.title, picture.picture_id, picture.created_at AS datte, AVG(rating.rate) AS average, tag.`name`
                        FROM picture
                        INNER JOIN picture_tag ON
                        picture.picture_id = picture_tag.picture_id
                        INNER JOIN tag ON
                        picture_tag.tag_id = tag.tag_id
                        INNER JOIN rating ON
                        picture.picture_id = rating.picture_id
                        WHERE tag.`name` = 'civilization'
                        GROUP BY picture_tag_id
                        ORDER BY picture.title;";
            }
            elseif($_GET['sort'] == 'fantasy'){
                $sql = "SELECT picture.path, picture.title, picture.picture_id, picture.created_at AS datte, AVG(rating.rate) AS average, tag.`name`
                        FROM picture
                        INNER JOIN picture_tag ON
                        picture.picture_id = picture_tag.picture_id
                        INNER JOIN tag ON
                        picture_tag.tag_id = tag.tag_id
                        INNER JOIN rating ON
                        picture.picture_id = rating.picture_id
                        WHERE tag.`name` = 'fantasy'
                        GROUP BY picture_tag_id
                        ORDER BY picture.title;";
            }
            elseif($_GET['sort'] == 'video game'){
                $sql = "SELECT picture.path, picture.title, picture.picture_id, picture.created_at AS datte, AVG(rating.rate) AS average, tag.`name`
                        FROM picture
                        INNER JOIN picture_tag ON
                        picture.picture_id = picture_tag.picture_id
                        INNER JOIN tag ON
                        picture_tag.tag_id = tag.tag_id
                        INNER JOIN rating ON
                        picture.picture_id = rating.picture_id
                        WHERE tag.`name` = 'video game'
                        GROUP BY picture_tag_id
                        ORDER BY picture.title;";
            }
            elseif($_GET['sort'] == 'nature'){
                $sql = "SELECT picture.path, picture.title, picture.picture_id, picture.created_at AS datte, AVG(rating.rate) AS average, tag.`name`
                        FROM picture
                        INNER JOIN picture_tag ON
                        picture.picture_id = picture_tag.picture_id
                        INNER JOIN tag ON
                        picture_tag.tag_id = tag.tag_id
                        INNER JOIN rating ON
                        picture.picture_id = rating.picture_id
                        WHERE tag.`name` = 'nature'
                        GROUP BY picture_tag_id
                        ORDER BY picture.title;";
            }
            elseif($_GET['sort'] == 'music'){
                $sql = "SELECT picture.path, picture.title, picture.picture_id, picture.created_at AS datte, AVG(rating.rate) AS average, tag.`name`
                        FROM picture
                        INNER JOIN picture_tag ON
                        picture.picture_id = picture_tag.picture_id
                        INNER JOIN tag ON
                        picture_tag.tag_id = tag.tag_id
                        INNER JOIN rating ON
                        picture.picture_id = rating.picture_id
                        WHERE tag.`name` = 'music'
                        GROUP BY picture_tag_id
                        ORDER BY picture.title;";
            }
            elseif($_GET['sort'] == 'sport'){
                $sql = "SELECT picture.path, picture.title, picture.picture_id, picture.created_at AS datte, AVG(rating.rate) AS average, tag.`name`
                        FROM picture
                        INNER JOIN picture_tag ON
                        picture.picture_id = picture_tag.picture_id
                        INNER JOIN tag ON
                        picture_tag.tag_id = tag.tag_id
                        INNER JOIN rating ON
                        picture.picture_id = rating.picture_id
                        WHERE tag.`name` = 'sport'
                        GROUP BY picture_tag_id
                        ORDER BY picture.title;";
            }
            elseif($_GET['sort'] == 'equipment'){
                $sql = "SELECT picture.path, picture.title, picture.picture_id, picture.created_at AS datte, AVG(rating.rate) AS average, tag.`name`
                        FROM picture
                        INNER JOIN picture_tag ON
                        picture.picture_id = picture_tag.picture_id
                        INNER JOIN tag ON
                        picture_tag.tag_id = tag.tag_id
                        INNER JOIN rating ON
                        picture.picture_id = rating.picture_id
                        WHERE tag.`name` = 'equipment'
                        GROUP BY picture_tag_id
                        ORDER BY picture.title;";
            }
            elseif($_GET['sort'] == 'brand'){
                $sql = "SELECT picture.path, picture.title, picture.picture_id, picture.created_at AS datte, AVG(rating.rate) AS average, tag.`name`
                        FROM picture
                        INNER JOIN picture_tag ON
                        picture.picture_id = picture_tag.picture_id
                        INNER JOIN tag ON
                        picture_tag.tag_id = tag.tag_id
                        INNER JOIN rating ON
                        picture.picture_id = rating.picture_id
                        WHERE tag.`name` = 'brand'
                        GROUP BY picture_tag_id
                        ORDER BY picture.title;";
            }
            elseif($_GET['sort'] == 'food'){
                $sql = "SELECT picture.path, picture.title, picture.picture_id, picture.created_at AS datte, AVG(rating.rate) AS average, tag.`name`
                        FROM picture
                        INNER JOIN picture_tag ON
                        picture.picture_id = picture_tag.picture_id
                        INNER JOIN tag ON
                        picture_tag.tag_id = tag.tag_id
                        INNER JOIN rating ON
                        picture.picture_id = rating.picture_id
                        WHERE tag.`name` = 'food'
                        GROUP BY picture_tag_id
                        ORDER BY picture.title;";
            }
            elseif($_GET['sort'] == 'science'){
                $sql = "SELECT picture.path, picture.title, picture.picture_id, picture.created_at AS datte, AVG(rating.rate) AS average, tag.`name`
                        FROM picture
                        INNER JOIN picture_tag ON
                        picture.picture_id = picture_tag.picture_id
                        INNER JOIN tag ON
                        picture_tag.tag_id = tag.tag_id
                        INNER JOIN rating ON
                        picture.picture_id = rating.picture_id
                        WHERE tag.`name` = 'science'
                        GROUP BY picture_tag_id
                        ORDER BY picture.title;";
            }
            elseif($_GET['sort'] == 'science fiction'){
                $sql = "SELECT picture.path, picture.title, picture.picture_id, picture.created_at AS datte, AVG(rating.rate) AS average, tag.`name`
                        FROM picture
                        INNER JOIN picture_tag ON
                        picture.picture_id = picture_tag.picture_id
                        INNER JOIN tag ON
                        picture_tag.tag_id = tag.tag_id
                        INNER JOIN rating ON
                        picture.picture_id = rating.picture_id
                        WHERE tag.`name` = 'science fiction'
                        GROUP BY picture_tag_id
                        ORDER BY picture.title;";
            }

            elseif($_GET['sort'] == 'newestASC'){
                $sql = "SELECT picture.path, picture.title, picture.picture_id, picture.created_at AS datte, AVG(rating.rate) AS average
                        FROM picture INNER JOIN rating ON
                        picture.picture_id = rating.picture_id
                        GROUP BY picture.title
                        ORDER BY picture.created_at ASC;";
            }
            elseif($_GET['sort'] == 'newestDESC'){
                $sql = "SELECT picture.path, picture.title, picture.picture_id, picture.created_at AS datte, AVG(rating.rate) AS average
                        FROM picture INNER JOIN rating ON
                        picture.picture_id = rating.picture_id
                        GROUP BY picture.title
                        ORDER BY picture.created_at DESC;";
            }
            elseif($_GET['sort'] == 'ratingASC'){
                $sql = "SELECT picture.path, picture.title, picture.picture_id, picture.created_at AS datte, AVG(rating.rate) AS average
                        FROM picture INNER JOIN rating ON
                        picture.picture_id = rating.picture_id
                        GROUP BY picture.title
                        ORDER BY average ASC;";
            }
            elseif($_GET['sort'] == 'ratingDESC'){
                $sql = "SELECT picture.path, picture.title, picture.picture_id, picture.created_at AS datte, AVG(rating.rate) AS average
                        FROM picture INNER JOIN rating ON
                        picture.picture_id = rating.picture_id
                        GROUP BY picture.title
                        ORDER BY average DESC;";
            }
            elseif($_GET['sort'] == 'alphabeticalASC'){
                $sql = "SELECT picture.path, picture.title, picture.picture_id, picture.created_at AS datte, AVG(rating.rate) AS average
                        FROM picture INNER JOIN rating ON
                        picture.picture_id = rating.picture_id
                        GROUP BY picture.title
                        ORDER BY picture.title ASC;";
            }
            elseif($_GET['sort'] == 'alphabeticalDESC'){
                $sql = "SELECT picture.path, picture.title, picture.picture_id, picture.created_at AS datte, AVG(rating.rate) AS average
                        FROM picture INNER JOIN rating ON
                        picture.picture_id = rating.picture_id
                        GROUP BY picture.title
                        ORDER BY picture.title DESC;";
            }
            elseif($_GET['sort'] == 'browse'){
                $sql = "SELECT picture.path, picture.title, picture.picture_id, picture.created_at AS datte, AVG(rating.rate) AS average
                        FROM picture INNER JOIN rating ON
                        picture.picture_id = rating.picture_id
                        GROUP BY picture.title
                        ORDER BY picture.path;";
            }


            $result = $object->query($sql);
            echo "<div class=\"results\">";

            if ($result->num_rows > 0){
                while ($row = $result->fetch_assoc()){
                    echo "<div class=\"result\">";
                    echo "<div class=\"resultImg\">"; ?>  <a href="picture.php?id=<?php echo $row['picture_id']?>"> <img class="img" src="<?php echo $row['path']; ?>"> </a> <?php echo "</div>"; ?>
                    <?php echo "<div class=\"resultText\"><h3>" . $row['title'] . "</h3></div>";
                    echo "<div class=\"resultText\"><h4>" . $row['datte'] . "</h4></div>";
                    echo "<div class=\"resultRating\"><h4>" . $row['average'] . "</h4></div></div>";
                    }
                }
            echo "</div>";
            
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
        <script type="text/javascript" src="../js/upload.js"></script>
    </body>
</html>
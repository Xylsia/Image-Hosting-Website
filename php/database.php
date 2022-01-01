<?php

    $sql = "SET FOREIGN_KEY_CHECKS = 0";
    $object->query($sql);

    $table_user = "DROP TABLE IF EXISTS `user`";
    $object->query($table_user) or die("drop did not happen for table user");
    
    $table_tag = "DROP TABLE IF EXISTS `tag`";
    $object->query($table_tag) or die("drop did not happen for table tag");

    $table_picture = "DROP TABLE IF EXISTS `picture`";
    $object->query($table_picture) or die("drop did not happen for table picture");

    $table_picture_tag = "DROP TABLE IF EXISTS `picture_tag`";
    $object->query($table_picture_tag) or die("drop did not happen for table picture_tag");

    $table_contact = "DROP TABLE IF EXISTS `contact`";
    $object->query($table_contact) or die("drop did not happen for table contact");

    $table_favorite = "DROP TABLE IF EXISTS `favorite`";
    $object->query($table_favorite) or die("drop did not happen for table favorite");

    $table_rating = "DROP TABLE IF EXISTS `rating`";
    $object->query($table_rating) or die("drop did not happen for table rating");

    $sql = "SET FOREIGN_KEY_CHECKS = 1";
    $object->query($sql);


    $table_user = "CREATE TABLE `user`  (
        `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
        `username` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
        `password_hash` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
        `email` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
        `display_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
        PRIMARY KEY (`user_id`) USING BTREE,
        UNIQUE INDEX `uq_user_username`(`username`) USING BTREE,
        UNIQUE INDEX `uq_user_email`(`email`) USING BTREE,
        UNIQUE INDEX `uq_user_display_name`(`display_name`) USING BTREE
      ) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic";
    $object->query($table_user) or die("create did not happen for table user"); 
    
    $table_tag = "CREATE TABLE `tag`  (
        `tag_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
        `name` enum('animal','anime','abstract','vehicle','civilization','fantasy','video game','nature','music','sport','equipment','brand','food','science','science fiction') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
        PRIMARY KEY (`tag_id`) USING BTREE,
        UNIQUE INDEX `uq_tag_name`(`name`) USING BTREE
      ) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic";
    $object->query($table_tag) or die("create did not happen for table tag");

    $table_picture = "CREATE TABLE `picture`  (
        `picture_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
        `user_id` int(10) UNSIGNED NOT NULL,
        `title` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
        `path` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
        `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp,
        PRIMARY KEY (`picture_id`) USING BTREE,
        UNIQUE INDEX `uq_picture_path`(`path`) USING BTREE,
        INDEX `fk_picture_user_id`(`user_id`) USING BTREE,
        CONSTRAINT `fk_picture_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
      ) ENGINE = InnoDB AUTO_INCREMENT = 42 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic";
    $object->query($table_picture) or die("create did not happen for table picture");
    
    $table_picture_tag = "CREATE TABLE `picture_tag`  (
        `picture_tag_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
        `picture_id` int(10) UNSIGNED NOT NULL,
        `tag_id` int(10) UNSIGNED,
        PRIMARY KEY (`picture_tag_id`) USING BTREE,
        UNIQUE INDEX `uq_picture_tag_picture_id_tag_id`(`picture_id`, `tag_id`) USING BTREE,
        INDEX `fk_picture_tag_tag_id`(`tag_id`) USING BTREE,
        CONSTRAINT `fk_picture_tag_picture_id` FOREIGN KEY (`picture_id`) REFERENCES `picture` (`picture_id`) ON DELETE CASCADE ON UPDATE CASCADE,
        CONSTRAINT `fk_picture_tag_tag_id` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`tag_id`) ON DELETE CASCADE ON UPDATE CASCADE
      ) ENGINE = InnoDB AUTO_INCREMENT = 65 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic";
    $object->query($table_picture_tag) or die("create did not happen for table picture_tag");  

    $table_contact = "CREATE TABLE `contact`  (
        `contact_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
        `user_id` int(10) UNSIGNED NOT NULL,
        `title` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
        `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
        `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp,
        PRIMARY KEY (`contact_id`) USING BTREE,
        INDEX `fk_contact_user_id`(`user_id`) USING BTREE,
        CONSTRAINT `fk_contact_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
      ) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic";
    $object->query($table_contact) or die("create did not happen for table contact"); 

    $table_favorite = "CREATE TABLE `favorite`  (
        `favorite_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
        `user_id` int(10) UNSIGNED NOT NULL,
        `picture_id` int(10) UNSIGNED NOT NULL,
        PRIMARY KEY (`favorite_id`) USING BTREE,
        UNIQUE INDEX `uq_favorite_user_id_picture_id`(`user_id`, `picture_id`) USING BTREE,
        INDEX `fk_favorite_picture_id`(`picture_id`) USING BTREE,
        CONSTRAINT `fk_favorite_picture_id` FOREIGN KEY (`picture_id`) REFERENCES `picture` (`picture_id`) ON DELETE CASCADE ON UPDATE CASCADE,
        CONSTRAINT `fk_favorite_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
      ) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic";
    $object->query($table_favorite) or die("create did not happen for table favorite");
    
    $table_rating = "CREATE TABLE `rating`  (
        `rating_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
        `user_id` int(10) UNSIGNED NOT NULL,
        `picture_id` int(10) UNSIGNED NOT NULL,
        `rate` enum('1','2','3','4','5') CHARACTER SET utf8 COLLATE utf8_unicode_ci,
        PRIMARY KEY (`rating_id`) USING BTREE,
        UNIQUE INDEX `uq_rating_user_id_picture_id`(`user_id`, `picture_id`) USING BTREE,
        INDEX `fk_rating_picture_id`(`picture_id`) USING BTREE,
        CONSTRAINT `fk_rating_picture_id` FOREIGN KEY (`picture_id`) REFERENCES `picture` (`picture_id`) ON DELETE CASCADE ON UPDATE CASCADE,
        CONSTRAINT `fk_rating_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
      ) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic";
    $object->query($table_rating) or die("create did not happen for table rating");


    $table_user = "INSERT INTO `user` VALUES
                (1, 'qwertyuiop', 'qwertyuiop', 'qwerty@gmail.com', 'qwerty'),
                (2, 'asdfghjkl', 'asdfghjkl', 'asdfgh@gmail.com', 'asdfgh'),
                (3, 'zxcvbnm', 'zxcvbnm', 'zxcvbn@yahoo.com', 'zxcvbn')";
    $object->query($table_user) or die("insert did not happen for table user");  
    
    $table_tag = "INSERT INTO `tag` VALUES
                (1, 'animal'),
                (2, 'anime'),
                (3, 'abstract'),
                (4, 'vehicle'),
                (5, 'civilization'),
                (6, 'fantasy'),
                (7, 'video game'),
                (8, 'nature'),
                (9, 'music'),
                (10, 'sport'),
                (11, 'equipment'),
                (12, 'brand'),
                (13, 'food'),
                (14, 'science'),
                (15, 'science fiction')";
    $object->query($table_tag) or die("insert did not happen for table tag");  
    
    $table_picture = "INSERT INTO `picture` VALUES
                    (1, 1, 'alienware', '../img/1.jpg', '2020-05-10 14:06:36'),
                    (2, 1, 'bird', '../img/2.jpg', '2020-05-10 14:06:51'),
                    (3, 1, 'basketball', '../img/3.jpg', '2020-05-10 14:07:03'),
                    (4, 1, 'juice', '../img/4.jpg', '2020-05-10 14:07:20'),
                    (5, 1, 'winter', '../img/5.jpg', '2020-05-10 14:07:30'),
                    (6, 1, 'beach', '../img/6.jpg', '2020-05-10 14:07:40'),
                    (7, 1, 'winter night', '../img/7.jpg', '2020-05-10 14:07:55'),
                    (8, 1, 'forest lake', '../img/8.jpg', '2020-05-10 14:08:14'),
                    (9, 1, 'cherry blosson tree', '../img/9.jpg', '2020-05-10 14:08:29'),
                    (10, 1, 'long river', '../img/10.jpg', '2020-05-10 14:08:40'),
                    (11, 2, 'winter sky', '../img/11.jpg', '2020-05-10 14:08:58'),
                    (12, 2, 'fall forest orange', '../img/12.jpg', '2020-05-10 14:09:19'),
                    (13, 2, 'mountains', '../img/13.jpg', '2020-05-10 14:09:32'),
                    (14, 2, 'sea', '../img/14.jpg', '2020-05-10 14:09:48'),
                    (15, 2, 'leopard', '../img/15.jpg', '2020-05-10 14:09:59'),
                    (16, 2, 'wolf', '../img/16.jpg', '2020-05-10 14:10:07'),
                    (17, 2, 'horse', '../img/17.jpg', '2020-05-10 14:10:18'),
                    (18, 2, 'lion', '../img/18.jpg', '2020-05-10 14:10:31'),
                    (19, 2, 'winter horse', '../img/19.jpg', '2020-05-10 14:10:42'),
                    (20, 2, 'dog', '../img/20.jpg', '2020-05-10 14:10:55'),
                    (21, 3, 'butterfly', '../img/21.jpg', '2020-05-10 14:11:07'),
                    (22, 3, 'owl', '../img/22.jpg', '2020-05-10 14:11:17'),
                    (23, 3, 'deer', '../img/23.jpg', '2020-05-10 14:11:27'),
                    (24, 3, 'tokyo ghoul', '../img/24.jpg', '2020-05-10 14:11:40'),
                    (25, 3, 'one piece luffy', '../img/25.jpg', '2020-05-10 14:11:50'),
                    (26, 3, 'naruto', '../img/26.jpg', '2020-05-10 14:12:00'),
                    (27, 3, 'sword art online', '../img/27.jpg', '2020-05-10 14:12:14'),
                    (28, 3, 'pokemon', '../img/28.jpg', '2020-05-10 14:12:35'),
                    (29, 3, 'one piece', '../img/29.jpg', '2020-05-10 14:12:46'),
                    (30, 3, 'anime', '../img/30.jpg', '2020-05-10 14:12:54'),
                    (31, 1, 'unicorn lake', '../img/31.jpg', '2020-05-10 14:13:11'),
                    (32, 1, 'dragon girl', '../img/32.jpg', '2020-05-10 14:13:22'),
                    (33, 1, 'castle', '../img/33.jpg', '2020-05-10 14:13:34'),
                    (34, 1, 'unicorn', '../img/34.jpg', '2020-05-10 14:13:43'),
                    (35, 1, 'east asia fantasy', '../img/35.jpg', '2020-05-10 14:14:00'),
                    (37, 1, 'league of legends', '../img/36.jpg', '2020-05-10 14:14:20'),
                    (38, 1, 'league of legends zed', '../img/37.jpg', '2020-05-10 14:16:00'),
                    (39, 2, 'league of legends lux', '../img/38.jpg', '2020-05-10 14:16:17'),
                    (40, 3, 'league of legends akali', '../img/39.jpg', '2020-05-10 14:16:29'),
                    (41, 2, 'world of warcraft', '../img/40.jpg', '2020-05-10 14:16:45')";
    $object->query($table_picture) or die("insert did not happen for table picture"); 
    
    $table_picture_tag = "INSERT INTO `picture_tag` VALUES
                        (1, 1, 11),
                        (2, 1, 12),
                        (3, 2, 1),
                        (4, 2, 8),
                        (5, 3, 10),
                        (6, 4, 13),
                        (7, 5, 8),
                        (8, 6, 8),
                        (9, 7, 8),
                        (10, 8, 8),
                        (11, 9, 8),
                        (12, 10, 8),
                        (13, 11, 8),
                        (14, 12, 8),
                        (15, 13, 8),
                        (16, 14, 8),
                        (17, 15, 8),
                        (18, 15, 1),
                        (19, 16, 1),
                        (20, 17, 1),
                        (21, 17, 8),
                        (22, 18, 1),
                        (23, 18, 8),
                        (24, 19, 1),
                        (25, 19, 8),
                        (26, 20, 1),
                        (27, 20, 8),
                        (28, 21, 1),
                        (29, 21, 8),
                        (30, 22, 1),
                        (31, 22, 8),
                        (32, 23, 1),
                        (33, 23, 8),
                        (34, 24, 2),
                        (35, 25, 2),
                        (36, 26, 2),
                        (37, 27, 2),
                        (38, 28, 2),
                        (39, 29, 2),
                        (40, 30, 2),
                        (41, 31, 6),
                        (42, 32, 6),
                        (43, 33, 6),
                        (44, 34, 6),
                        (45, 34, 3),
                        (46, 35, 6),
                        (47, 35, 3),
                        (48, 37, 7),
                        (49, 38, 7),
                        (50, 39, 7),
                        (51, 40, 7),
                        (52, 41, 7),
                        (53, 39, 9),
                        (54, 33, 5),
                        (55, 30, 8),
                        (56, 23, 14),
                        (57, 22, 15)";
    $object->query($table_picture_tag) or die("insert did not happen for table picture_tag"); 
    
    $table_contact = "INSERT INTO `contact` VALUES
                    (1, 1, 'send help', 'uwu owo uwu owo uwu owo uwu owo uwu owo', '2020-05-10 14:24:00'),
                    (2, 2, 'truwu', 'NANI NANI NANI NANI NANI NANI NANI', '2020-05-10 14:24:13')";
    $object->query($table_contact) or die("insert did not happen for table contact");   
 
    $table_favorite = "INSERT INTO `favorite` VALUES
                    (1, 1, 1),
                    (2, 1, 2),
                    (3, 1, 3),
                    (4, 2, 1),
                    (5, 2, 4),
                    (6, 2, 5),                   
                    (7, 3, 3),
                    (8, 3, 1),
                    (9, 1, 6),
                    (10, 3, 2),
                    (11, 1, 7),
                    (12, 1, 8),
                    (13, 1, 9),
                    (14, 1, 10),
                    (15, 1, 11),
                    (16, 1, 12),
                    (17, 1, 13),
                    (18, 1, 14),
                    (19, 1, 15),
                    (20, 1, 16),
                    (21, 1, 17),
                    (22, 1, 18),
                    (23, 1, 19),
                    (24, 1, 20),
                    (25, 1, 21),
                    (26, 1, 22),
                    (27, 1, 23),
                    (28, 1, 24),
                    (29, 1, 25),
                    (30, 1, 26),
                    (31, 1, 27),
                    (32, 1, 28),
                    (33, 1, 29),
                    (34, 1, 30),
                    (35, 1, 31),
                    (36, 1, 32),
                    (37, 1, 33),
                    (38, 1, 34),
                    (39, 1, 35),
                    (40, 1, 37),
                    (41, 1, 38),
                    (42, 1, 39),
                    (43, 1, 40),
                    (44, 1, 41),
                    (45, 2, 17),
                    (46, 2, 18),
                    (47, 2, 19),
                    (48, 2, 20),
                    (49, 2, 21),
                    (50, 2, 22),
                    (51, 2, 23),
                    (52, 2, 24),
                    (53, 2, 25),
                    (54, 2, 26),
                    (55, 2, 27),
                    (56, 2, 28),
                    (57, 2, 29),
                    (58, 2, 30),
                    (59, 2, 31),
                    (60, 2, 32),
                    (61, 2, 33),
                    (62, 3, 17),
                    (63, 3, 18),
                    (64, 3, 19),
                    (65, 3, 20),
                    (66, 3, 21),
                    (67, 3, 22),
                    (68, 3, 23),
                    (69, 3, 24),
                    (70, 3, 25),
                    (71, 3, 26),
                    (72, 3, 27),
                    (73, 3, 28),
                    (74, 3, 29),
                    (75, 3, 30),
                    (76, 3, 31),
                    (77, 3, 32),
                    (78, 3, 33),
                    (79, 3, 34),
                    (80, 3, 35),
                    (81, 3, 37),
                    (82, 3, 38)";
    $object->query($table_favorite) or die("insert did not happen for table favorite"); 
    
    $table_rating = "INSERT INTO `rating` VALUES
                    (1, 1, 1, '4'),
                    (2, 1, 2, '4'),
                    (3, 1, 3, '2'),
                    (4, 1, 4, '5'),
                    (5, 1, 5, '4'),
                    (6, 2, 1, '1'),
                    (7, 2, 2, '2'),
                    (8, 2, 3, '3'),
                    (9, 2, 4, '4'),
                    (10, 2, 5, '5'),
                    (11, 3, 1, '5'),
                    (12, 3, 2, '2'),
                    (13, 3, 3, '3'),
                    (14, 3, 4, '2'),
                    (15, 3, 5, '2'),
                    (16, 1, 6, '2'),
                    (17, 2, 6, '3'),
                    (18, 3, 6, '5'),
                    (19, 1, 7, '1'),
                    (20, 2, 7, '3'),
                    (21, 3, 7, '3'),
                    (22, 1, 8, '1'),
                    (23, 2, 8, '2'),
                    (24, 3, 8, '3'),
                    (25, 1, 9, '3'),
                    (26, 2, 9, '3'),
                    (27, 3, 9, '3'),
                    (28, 1, 10, '5'),
                    (29, 2, 10, '2'),
                    (30, 3, 10, '3'),
                    (31, 1, 11, '5'),
                    (32, 2, 11, '5'),
                    (33, 3, 11, '5'),
                    (34, 1, 12, '1'),
                    (35, 2, 12, '1'),
                    (36, 3, 12, '2'),
                    (37, 1, 13, '5'),
                    (38, 2, 13, '4'),
                    (39, 3, 13, '4'),
                    (40, 1, 14, '1'),
                    (41, 2, 14, '1'),
                    (42, 3, 14, '4'),
                    (43, 1, 15, '3'),
                    (44, 2, 15, '3'),
                    (45, 3, 15, '4'),
                    (46, 1, 16, '1'),
                    (47, 2, 16, '2'),
                    (48, 3, 16, '3'),
                    (49, 1, 17, '4'),
                    (50, 2, 17, '4'),
                    (51, 3, 17, '1'),
                    (52, 1, 18, '3'),
                    (53, 2, 18, '3'),
                    (54, 3, 18, '3'),
                    (55, 1, 19, '2'),
                    (56, 2, 19, '2'),
                    (57, 3, 19, '3'),
                    (58, 1, 20, '2'),
                    (59, 2, 20, '2'),
                    (60, 3, 20, '2'),
                    (61, 1, 21, '4'),
                    (62, 2, 21, '4'),
                    (63, 3, 21, '4'),
                    (64, 1, 22, '1'),
                    (65, 2, 22, '1'),
                    (66, 3, 22, '4'),
                    (67, 1, 23, '1'),
                    (68, 2, 23, '2'),
                    (69, 3, 23, '3'),
                    (70, 1, 24, '5'),
                    (71, 2, 24, '5'),
                    (72, 3, 24, '4'),
                    (73, 1, 25, '5'),
                    (74, 2, 25, '4'),
                    (75, 3, 25, '4'),
                    (76, 1, 26, '5'),
                    (77, 2, 26, '2'),
                    (78, 3, 26, '1'),
                    (79, 1, 27, '1'),
                    (80, 2, 27, '4'),
                    (81, 3, 27, '4'),
                    (82, 1, 28, '1'),
                    (83, 2, 28, '3'),
                    (84, 3, 28, '5'),
                    (85, 1, 29, '1'),
                    (86, 2, 29, '1'),
                    (87, 3, 29, '5'),
                    (88, 1, 30, '1'),
                    (89, 2, 30, '1'),
                    (90, 3, 30, '2'),
                    (91, 1, 31, '1'),
                    (92, 2, 31, '3'),
                    (93, 3, 31, '3'),
                    (94, 1, 32, '4'),
                    (95, 2, 32, '4'),
                    (96, 3, 32, '2'),
                    (97, 1, 33, '5'),
                    (98, 2, 33, '5'),
                    (99, 3, 33, '5'),
                    (100, 1, 34, '4'),
                    (101, 2, 34, '3'),
                    (102, 3, 34, '2'),
                    (103, 1, 35, '1'),
                    (104, 2, 35, '1'),
                    (105, 3, 35, '2'),
                    (106, 1, 37, '4'),
                    (107, 2, 37, '4'),
                    (108, 3, 37, '4'),
                    (109, 1, 38, '5'),
                    (110, 2, 38, '5'),
                    (111, 3, 38, '3'),
                    (112, 1, 39, '5'),
                    (113, 2, 39, '4'),
                    (114, 3, 39, '4'),
                    (115, 1, 40, '3'),
                    (116, 2, 40, '3'),
                    (117, 3, 40, '4'),
                    (118, 1, 41, '1'),
                    (119, 2, 41, '1'),
                    (120, 3, 41, '4')";
    $object->query($table_rating) or die("insert did not happen for table rating");                 
    
?>
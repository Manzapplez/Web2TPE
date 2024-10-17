<?php

class DbHelper {

    public static function tryCreateDB() {
        $db = DB_NAME;
        $pdo = new PDO('mysql:host=' . DB_HOST, DB_USER, DB_PASS);
        $query = "CREATE DATABASE IF NOT EXISTS $db";
        $pdo->exec($query);
    }

    public static function deploy($db) {
        $query = $db->query('SHOW TABLES');
        $tables = $query->fetchAll();
        
        if ( count($tables) == 0 ) {
            $hash = ''; ////////////////////////////////////////////////////////////////////////
            $sql = <<<END
            -- phpMyAdmin SQL Dump
            -- version 5.2.1
            -- https://www.phpmyadmin.net/
            --
            -- Host: 127.0.0.1
            -- Generation Time: Sep 18, 2024 at 11:47 PM
            -- Server version: 10.4.32-MariaDB
            -- PHP Version: 8.2.12
            
            SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
            START TRANSACTION;
            SET time_zone = "+00:00";
            
            
            /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
            /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
            /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
            /*!40101 SET NAMES utf8mb4 */;
            
            --
            -- Database: `web2_tpe`
            --
            
            -- --------------------------------------------------------
            
            --
            -- Table structure for table `movies`
            --
            
            CREATE TABLE `movies` (
              `id_movie` int(11) NOT NULL,
              `title` varchar(200) NOT NULL,
              `director` varchar(150) NOT NULL,
              `synopsis` varchar(400) NOT NULL,
              `release_date` year(4) NOT NULL,
              `runtime` int(11) NOT NULL,
              `genre` varchar(100) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
            
            --
            -- Dumping data for table `movies`
            --
            
            INSERT INTO `movies` (`id_movie`, `title`, `director`, `synopsis`, `release_date`, `runtime`, `genre`) VALUES
            (1, 'The Lord of the Rings: The Fellowship of the Ring', 'Peter Jackson', 'A meek Hobbit from the Shire and eight companions set out on a journey to destroy the powerful One Ring and save Middle-earth from the Dark Lord Sauron.', '2001', 178, 'Fantasy/Adventure');
            
            -- --------------------------------------------------------
            
            --
            -- Table structure for table `reviews`
            --
            
            CREATE TABLE `reviews` (
              `id_review` int(11) NOT NULL,
              `id_user` int(11) NOT NULL,
              `id_movie` int(11) NOT NULL,
              `body` varchar(500) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
            
            --
            -- Dumping data for table `reviews`
            --
            
            INSERT INTO `reviews` (`id_review`, `id_user`, `id_movie`, `body`) VALUES
            (1, 2, 1, 'Elijah Wood should wear wigs');
            
            -- --------------------------------------------------------
            
            --
            -- Table structure for table `users`
            --
            
            CREATE TABLE `users` (
              `id_user` int(11) NOT NULL,
              `username` varchar(50) NOT NULL,
              `email` varchar(320) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
            
            --
            -- Dumping data for table `users`
            --
            
            INSERT INTO `users` (`id_user`, `username`, `email`) VALUES
            (1, 'glupshitto', 'sglup@mock.com'),
            (2, 'DiscoGirl', 'babbalover@mock.com');
            
            --
            -- Indexes for dumped tables
            --
            
            --
            -- Indexes for table `movies`
            --
            ALTER TABLE `movies`
              ADD PRIMARY KEY (`id_movie`);
            
            --
            -- Indexes for table `reviews`
            --
            ALTER TABLE `reviews`
              ADD PRIMARY KEY (`id_review`),
              ADD KEY `fk_Reviews_Users` (`id_user`),
              ADD KEY `fk_Reviews_Movies` (`id_movie`);
            
            --
            -- Indexes for table `users`
            --
            ALTER TABLE `users`
              ADD PRIMARY KEY (`id_user`),
              ADD UNIQUE KEY `email` (`email`);
            
            --
            -- AUTO_INCREMENT for dumped tables
            --
            
            --
            -- AUTO_INCREMENT for table `movies`
            --
            ALTER TABLE `movies`
              MODIFY `id_movie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
            
            --
            -- AUTO_INCREMENT for table `users`
            --
            ALTER TABLE `users`
              MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
            
            --
            -- Constraints for dumped tables
            --
            
            --
            -- Constraints for table `reviews`
            --
            ALTER TABLE `reviews`
              ADD CONSTRAINT `fk_Reviews_Movies` FOREIGN KEY (`id_movie`) REFERENCES `movies` (`id_movie`),
              ADD CONSTRAINT `fk_Reviews_Users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);
            END;
            $db->query($sql);
        }
    }
}
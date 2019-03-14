<?php

  class DB   {

    // Used for DB Connexion
    const DB_SERVERNAME = "localhost";
    const DB_USERNAME = "root";
    const DB_PASSWD = "root";
    const DB_NAME = "quizzes";

    /* Méthode pour solliciter la base de données */

    public function db_select($sql) {

      // Connexion
      $connexion = new mysqli(self::DB_SERVERNAME, self::DB_USERNAME, self::DB_PASSWD, self::DB_NAME);

      // Vérification de la validité de la connexion
      if ($connexion->connect_error) {
          die("Erreur de connexion à la base de données : " . $connexion->connect_error);
      }

      // Définit utf8 comme jeu de caractères par défaut
      $connexion->set_charset("utf8");


      // Requête SQL
      $result = $connexion->query($sql);

      $connexion->close();

      // Traitement du résultat de la requête
      if($result->num_rows > 0) {

        $rows = array();

        while($row = $result->fetch_assoc()) {

          array_push($rows, $row);

        }

        return $rows;

      }
      else {

        return false;

      }

    }

    /* Méthode pour créer les tables en BDD */
    public static function tablesExist() {

      // Create connection
      $connexion = new mysqli(self::DB_SERVERNAME, self::DB_USERNAME, self::DB_PASSWD, self::DB_NAME);
      // Check connection
      if ($connexion->connect_error) {
          die("Erreur de connexion à la base de données : " . $connexion->connect_error);
      }

      $return = (
        $connexion->query("SHOW TABLES LIKE 'question'")
        && $connexion->query("SHOW TABLES LIKE 'quizz'")
        && $connexion->query("SHOW TABLES LIKE 'reponse'")
      ) ? true : false;

      $connexion->close();

      return $return;

    }

    /* Méthode pour créer les tables en BDD */
    public static function createTables() {

      // Create connection
      $connexion = new mysqli(self::DB_SERVERNAME, self::DB_USERNAME, self::DB_PASSWD, self::DB_NAME);
      // Check connection
      if ($connexion->connect_error) {
          die("Erreur de connexion à la base de données : " . $connexion->connect_error);
      }

      // Création table Question
      $sql = "CREATE TABLE IF NOT EXISTS `question` (
        `id` int(55) NOT NULL AUTO_INCREMENT,
        `quizz_id` int(20) NOT NULL,
        `text` text COLLATE utf8_unicode_ci NOT NULL,
        PRIMARY KEY (`id`),
        KEY `quizz_id` (`quizz_id`)
      ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;";

      if ($connexion->query($sql) === TRUE) {
          echo "Table `question` created successfully";
      } else {
          echo "Erreur lors de la création de la table `question` : " . $connexion->error;
      }

      // sql to create table
      $sql = "CREATE TABLE IF NOT EXISTS `quizz` (
        `id` tinyint(5) NOT NULL AUTO_INCREMENT,
        `title` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;";

      if ($connexion->query($sql) === TRUE) {
          echo "Table `quizz` created successfully";
      } else {
          echo "Erreur lors de la création de la table `quizz` : " . $connexion->error;
      }

      // sql to create table
      $sql = "CREATE TABLE IF NOT EXISTS `reponse` (
        `id` int(55) NOT NULL AUTO_INCREMENT,
        `question_id` int(55) NOT NULL,
        `text` text COLLATE utf8_unicode_ci NOT NULL,
        `correct` tinyint(1) NOT NULL,
        PRIMARY KEY (`id`),
        KEY `question_id` (`question_id`)
      ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;";

      if ($connexion->query($sql) === TRUE) {
          echo "Table `reponse` created successfully";
      } else {
          echo "Erreur lors de la création de la table `reponse` : " . $connexion->error;
      }

      $connexion->close();

    }

  }

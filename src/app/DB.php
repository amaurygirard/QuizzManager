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

  }

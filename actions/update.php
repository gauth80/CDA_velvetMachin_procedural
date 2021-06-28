<?php
  require_once('./../config/dsn.php');
  $dsn = connexionBase();

  if(isset($_POST['disc_id']) && !empty($_POST['disc_id'])) {

    $getErrorAuthor = $getErrorAlbum = $getErrorGenre = $getErrorYear = $getErrorPrice = $getErrorImg String '';
    $id = trim($_POST['disc_id'], ' \n\r\t') : int;
    $author = trim($_POST['artist_name'], ' \n\r\t') : string;
    $album = trim($_POST['disc_title'], ' \n\r\t') : string;
    $genre = trim($_POST['disc_genre'], ' \n\r\t') : string;
    $year = trim($_POST['disc_year'], ' \n\r\t') : string;
    $price = trim($_POST['disc_price'], ' \n\r\t' : int;

    $_name ="/[a-zA-Z]+(?:(?:\-| |\')?[a-zA-Z]+){0,9}/";
    $_price = "/[0-9][0-9]{0,4}/";
    $_extend = array("image/jpg","image/jpeg","image/png");

    $imgFile = $_FILES['upload']['name'];
    $tmp_dir = $_FILES['upload']['tmp_name'];
    $imgSize = $_FILES['upload']['size'];

    $dirFolder = "./../public/media/img/";
    $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION));
    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif');
    $newName = $id . "." . $imgExt;


    if(empty($getAuthor)) {
        $getErrorAuthor = "Veuillez entrée l'auteur.";
    } elseif(!preg_match($_name, $getAuthor)) {
        $getErrorAuthor = "Pas de caractère spécial";
    } else {
        $author = $getAuthor;
    }

    if(empty($getAlbum)) {
        $getErrorAlbum = "Veuillez entrée l'album.";
    } elseif(!preg_match($_name, $getAlbum)) {
        $getErrorAlbum = "Pas de caractère spécial";
    } else {
        $album = $getAlbum;
    }

    if(empty($getGenre)) {
        $getErrorGenre = "Veuillez entrée le genre.";
    } elseif(!preg_match($_name, $getGenre)) {
        $getErrorGenre = "Pas de caractère spécial";
    } else {
        $genre = $getGenre;
    }

    if(empty($getPrice)) {
        $getErrorPrice = "Veuillez entrée le prix.";
    } elseif(!preg_match($_price, $getPrice)) {
        $getErrorPrice = "Pas de caractère spécial";
    } else {
        $price = $getPrice;
    }

    if(in_array($imgExt, $valid_extensions)){
      if($imgSize < 10000000) {
         move_uploaded_file($tmp_dir, $dirFolder . $newName);
      } else {
        // Si l'img dépasse la taille, c'est que ce n'est pas une image.
         $getErrorImg = "Taille de l'image trop grande";
      }
    } elseif(empty($imgFile)) {
      $getErrorImg = "Veuillez indiquez une image";
    } else {
      $getErrorImg = "Seul les jpg/jpeg - png et gif sont valides.";
    }

    if(empty($getErrorImg) && empty($getErrorAlbum) && empty($getErrorGenre) && empty($getErrorPrice) && empty($getErrorAuthor)) {
      $sql = 'UPDATE disc LEFT JOIN artist ON disc.disc_id = artist.artist_id SET disc_year=:disc_year, disc_genre=:disc_genre, disc_price=:disc_price, disc_title=:disc_title, artist_name=:artist_name WHERE disc_id =:disc_id';

      if($statement = $dsn->prepare($sql)) {

        $statement->bindParam(":disc_year", $bindYear);
        $statement->bindParam(":disc_genre", $bindGenre);
        $statement->bindParam(":disc_price", $bindPrice);
        $statement->bindParam(":disc_title", $bindTitle);
        $statement->bindParam(":artist_name", $bindName);

        $bindYear = $year;
        $bindGenre = $genre;
        $bindPrice = $price;
        $bindTitle = $album;
        $bindName = $author;

        if($statement->execute()) {
          header('location: ./../src/index.php');
          exit();
        } else {
          echo "erreur 503 : Serveur indisponible pour le moment";
        }
      }
      unset($statement);
    }
    unset($dsn);
  } else {
    
    die();
  }

 ?>

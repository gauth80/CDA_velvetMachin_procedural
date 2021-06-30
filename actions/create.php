<?php
  require_once('./../config/dsn.php');
  $dsn = connexionBase();

  if($_SERVER['REQUEST_METHOD'] == 'POST') {

    //A0 init var
    $getErrorScript = $getErrorAuthor = $getErrorAlbum = $getErrorGenre = $getErrorYear = $getErrorPrice = (String) $getErrorImg ='';

    //A1 bind values
    $author = (String) trim($_POST['name'], ' \n\r\t');
    $album = (String) trim($_POST['title'], ' \n\r\t');
    $genre = (String) trim($_POST['genre'], ' \n\r\t');
    $year = (String) trim($_POST['year'], ' \n\r\t');
    $price = (Int) trim($_POST['price'], ' \n\r\t');

    //=A2 checked img
    $imgFile = $_FILES['upload']['name'];
    $tmp_dir = $_FILES['upload']['tmp_name'];
    $imgSize = $_FILES['upload']['size'];

    $dirFolder = "./../public/media/img/";
    $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION));
    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif');
    $newName = $id . "." . $imgExt;


    //A3 checked input
    if(empty($getAuthor)) {
        $getErrorAuthor = "Veuillez indiquez le nom de l'auteur";
    } elseif(!filter_var($getAuthor, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z]*$/")))) {
        $getErrorAuthor = "Caractères non valide";
    } elseif(strlen(trim($getAuthor)) < 3 || strlen(trim($getAuthor)) > 16) {
        $getErrorAuthor = "Ce champs doit comportée au minimum trois caractères et un maximum de 16 caractères";
    } else {
        $author = $getAuthor;
    }

    if(empty($getAlbum)) {
        $getErrorAlbum = "Veuillez indiquez le titre de l'album";
    } elseif(!filter_var($getAlbum, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z]*$/")))) {
        $getErrorAlbum = "Caractères non valide";
    } elseif(strlen(trim($getAlbum)) < 3 || strlen(trim($getAlbum)) > 16) {
        $getErrorAlbum = "Ce champs doit comportée au minimum trois caractères et un maximum de 16 caractères";
    } else {
        $album = $getAlbum;
    }

    if(empty($getYear)) {
        $getErrorYear = "Veuillez indiquez l'année d'édition";
    } elseif(!filter_var($getYear, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/[0-9]{2}(?:(\/|-))[0-9]{2}(?:(\/|-))[0-9]{4}|[0-9]{4}(?:(\/|-))[0-9]{2}(?:(\/|-))[0-9]{2}/")))) {
        $getErrorYear = "Caractères non valide";
    } else {
        $year = $getYear;
    }


    if(empty($getPrice)) {
      $getErrorPrice = "Veuillez indiquez le prix de l'article";
    } elseif(!filter_var($getPrice, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/[0-9]{2}(?:(\/|-))[0-9]{2}(?:(\/|-))[0-9]{4}|[0-9]{4}(?:(\/|-))[0-9]{2}(?:(\/|-))[0-9]{2}/")))) {
      $getErrorPrice = "Caractères non valide";
    } else {
      $price = $getPrice;
    }


    if(in_array($imgExt,$valid_extensions)) {
        $extension = substr(strrchr($_FILES["upload"]["name"], "."),1);
        exit();
    } elseif(empty($imgFile)) {
        $getErrorImg = "Veuillez indiquez une image";
    } else {
        $getErrorImg = "Seul les jpg et png sont valides.";
    }





    //A5 envoie
      if(empty($getErrorImg) && empty($getErrorYear) && empty($getErrorAlbum) && empty($getErrorPrice) && empty($getErrorAuthor)) {

        $sql = 'INSERT INTO disc (disc_title, disc_genre, disc_year, disc_price) VALUES (title=:disc_title, genre=:disc_genre, year=:disc_year);
        INSERT INTO artist (artist_name) values ('name=:artist_name');';

        if($statement = $dsn->prepare($sql)) {

          $statement->bindParam(':disc_id', $bindIdDisc);
          $statement->bindParam(':artist_id', $bindIdArtist);
          $statement->bindParam(":disc_year", $bindYear);
          $statement->bindParam(":disc_genre", $bindGenre);
          $statement->bindParam(":disc_price", $bindPrice);
          $statement->bindParam(":disc_title", $bindTitle);
          $statement->bindParam(":artist_name", $bindName);
          $id = $dsn->lastInsertId();

          $bindYear = $year;
          $bindGenre = $genre;
          $bindPrice = $price;
          $bindTitle = $album;
          $bindName = $author;

            if($imgSize < 10000000) {
              move_uploaded_file($tmp_dir,$dirFolder.$id.$extension);
                  if(empty($tmp_dir))
                      $getErrorScript = "tmp_dir == undefined";
                      exit();
            } else {
                $getErrorImg = "image trop volumineuse !";
            }


            if($statement->execute()) {
              exit();
            } else {
              $getErrorScript = "erreur Script : la requète n'as pas aboutis";
            }
          }
          unset($statement):
        }
        unset($dsn);
      }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>form | Ajout</title>
</head>
<body>
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">
    <fieldset>
      <legend>formulaire d'ajout</legend>
      <label for="name">
        <input type="text" placeholder="Auteur" name="name">
        <span class="warning"><?php echo $getErrorAuthor;?></span>
      </label>
      <label for="title">
        <input type="text" placeholder="Album" name="title">
        <span class="warning"><?php echo $getErrorAlbum;?></span>
      </label>
      <label for="genre">
        <input type="text" placeholder="genre musical" name="genre">
        <span class="warning"><?php echo $getErrorGenre;?></span>
      </label>
      <label for="year">
        <input type="date" name="year">
        <span class="warning"><?php echo $getErrorYear;?></span>
      </label>
      <label for="price">
        <input type="text" name="price">
        <span class="warning"><?php echo $getErrorPrice;?></span>
      </label>

      <button class="btn primary" type="submit" value="submit">Ajouter</button>
    </fieldset>

  </form>
</body>
</html>

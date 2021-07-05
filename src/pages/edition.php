<?php
  /* breakpoints =1 =2*/

  // paramètres du site
  include('../templates/fonctions.php');
  require_once('../../config/dsn.php');
  $file = '../styles/formatage/prettyCss.json';
  $data = file_get_contents($file, false);
  $obj = json_decode($data);

  // Indicateur | cast
  (String)
  $getErrorScript =
  $getErrorAuthor =
  $getErrorAlbum =
  $getErrorGenre =
  $getErrorYear =
  $getErrorPrice =
  $getErrorImg =
  $getMessage = "";

  if(isset($_POST['edit'])) {

    function checkedData($getData) {
      $getData = trim($getData, ' \n\r\t');
      $getData = htmlspecialchars($getData);
      return $getData;
    }


  $getAuthor = checkedData($_POST['name']);
  $getAlbum = checkedData($_POST['title']);
  $getGenre = checkedData($_POST['genre']);
  $getYear = checkedData($_POST['year']);
  $getPrice = checkedData($_POST['price']);


  //whiteList
  $_extend = array("image/jpg","image/jpeg","image/png");

  // config img
  $imgFile = $_FILES['upload']['name'];
  $tmp_dir = $_FILES['upload']['tmp_name'];
  $imgSize = $_FILES['upload']['size'];

  $dirFolder = "./../public/media/img/";
  $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION));
  $valid_extensions = array('jpeg', 'jpg', 'png', 'gif');




  //A3 checked input
  /*if(!isset($getAuthor)) {
      $getErrorAuthor = "Veuillez indiquez le nom de l'auteur";
  } elseif(!filter_var($getAuthor, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z]*$/")))) {
      $getErrorAuthor = "Caractères non valide";
  } elseif(strlen(trim($getAuthor)) < 3 || strlen(trim($getAuthor)) > 16) {
      $getErrorAuthor = "Ce champs doit comportée au minimum trois caractères et un maximum de 16 caractères";
  } else {
      $author = $getAuthor;
      var_dump($author);
  }

  if(!isset($getAlbum)) {
      $getErrorAlbum = "Veuillez indiquez le titre de l'album";
  } elseif(!filter_var($getAlbum, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z]*$/")))) {
      $getErrorAlbum = "Caractères non valide";
  } elseif(strlen(trim($getAlbum)) < 3 || strlen(trim($getAlbum)) > 16) {
      $getErrorAlbum = "Ce champs doit comportée au minimum trois caractères et un maximum de 16 caractères";
  } else {
      $album = $getAlbum;
  }

  if(!isset($getGenre)) {
      $getErrorGenre = "Veuillez indiquez le titre de l'album";
  } elseif(!filter_var($getGenre, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z]*$/")))) {
      $getErrorGenre = "Caractères non valide";
  } elseif(strlen(trim($getGenre)) < 3 || strlen(trim($getGenre)) > 16) {
      $getErrorGenre = "Ce champs doit comportée au minimum trois caractères et un maximum de 16 caractères";
  } else {
      $genre = $getGenre;
  }

  if(!isset($getYear)) {
      $getErrorYear = "Veuillez indiquez l'année d'édition";
  } elseif(!filter_var($getYear, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/[0-9]{2}(?:(\/|-))[0-9]{2}(?:(\/|-))[0-9]{4}|[0-9]{4}(?:(\/|-))[0-9]{2}(?:(\/|-))[0-9]{2}/")))) {
      $getErrorYear = "Caractères non valide";
  } else {
      $year = $getYear;
  }


  if(!isset($getPrice)) {
    $getErrorPrice = "Veuillez indiquez le prix de l'article";
  } elseif(!filter_var($getPrice, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/[0-9]{1,}[.]{0,1}[0-9]{0,2}/")))) {
    $getErrorPrice = "Caractères non valide";
  } else {
    $price = $getPrice;
  }*/


  if(in_array($imgExt, $valid_extensions)) {
      $extension = substr(strrchr($_FILES["upload"]["name"], "."),1);
      exit();
  } elseif(empty($imgFile)) {
      $getErrorImg = "Veuillez indiquez une image";
  } else {
      $getErrorImg = "Seul les jpg et png sont valides.";
  }



  //A5 envoie
    if(isset($album) && isset($year) && isset($genre) && isset($price)) {
      //empty($getErrorImg) && empty($getErrorYear) && empty($getErrorAlbum) && empty($getErrorPrice) && empty($getErrorAuthor) && empty($getErrorGenre)
      header('location: ../../src/index.php');

      $sql = "INSERT INTO disc (disc_title, disc_genre, disc_year, disc_price) VALUES (
        ?,?,?,?)";

      if($statement = $dsn->prepare($sql)) {
        header('location: ../../src/index.php');

          if($imgSize < 10000000) {
            move_uploaded_file($tmp_dir,$dirFolder.$id.$extension);
                if(empty($tmp_dir)) {
                  exit();
                  $getErrorScript = "tmp_dir == undefined";
                }

          } else {
              $getErrorImg = "image trop volumineuse !";
          }


          if($statement->execute(array($album, $genre, $year,$price))) {
            header('location: ../../src/index.php');

          } else {
            $getErrorScript = "erreur Script : la requète n'as pas aboutis";
          }
        }
        unset($statement);
        header('location: ../../src/index.php');
      }
      unset($dsn);
    }

?>

<?= entete(
  "Velvet Record | Edition",
  "./../styles/css/styles.css",
    [
      "./../index.php",
      "../index.php",
      "other.php"
    ],
    [
      "Accueil",
      "Contact",
      "As propos"
    ]
  ) ;?>


  <section class="row mt-5">
    <form class="<?= $obj->form ?>" action="<?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
      <fieldset class=" row form_border">
        <legend class="form_title">Editée un article</legend>

        <label for="name" class="<?= $obj->cell?>">
          <input type="text" placeholder="Auteur" name="name">
          <?php if(isset($getErrorAuthor)) :?>
            <span class="warning">
              <?=$getErrorAuthor;?>
            </span>
          <?php endif; ?>
        </label>

        <label for="title" class="<?= $obj->cell?>">
          <input type="text" placeholder="Album" name="title">
          <?php if(isset($getErrorAlbum)) :?>
            <span class="warning">
              <?=$getErrorAlbum;?>
            </span>
          <?php endif; ?>
        </label>

        <label for="genre" class="<?= $obj->cell?>">
          <input type="text" placeholder="genre musical" name="genre">
          <?php if(isset($getErrorGenre)) :?>
            <span class="warning">
              <?=$getErrorGenre;?>
            </span>
          <?php endif; ?>
        </label>

        <label for="year" class="<?= $obj->cell?>">
          <input type="date" name="year">
          <?php if(isset($getErrorYear)) :?>
            <span class="warning">
              <?=$getErrorYear;?>
            </span>
          <?php endif; ?>
        </label>

        <label for="price" class="<?= $obj->cell?>">
          <input type="text" placeholder="ajouter un prix" name="price">
          <?php if(isset($getErrorPrice)) :?>
            <span class="warning">
              <?=$getErrorPrice;?>
            </span>
          <?php endif; ?>
         </label>

        <label for="upload" class="<?= $obj->cell?>">
          <input type="file" name="upload">
          <?php if(isset($getErrorImg)) :?>
            <span class="warning">
              <?=$getErrorImg;?>
            </span>
          <?php endif; ?>
        </label>

        <div class="row">
          <input class="btn primary" type="submit" value="edit" name="edit"/>
        </div>
      </fieldset>
    </form>
  </section>

<?= footer() ;?>

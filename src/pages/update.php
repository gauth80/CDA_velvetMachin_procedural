<?php

  include('../templates/fonctions.php');
  $dns = require_once('../../config/dsn.php');
  $file = '../../public/styles/formatage/prettyCss.json';
  $data = file_get_contents($file, false);
  $obj = json_decode($data);
?>


<?php
  if(isset($_POST['up']) && isset($_GET['id'])) {

  $id = $_GET['id'];
  $album = $_POST['title'];
  $year = $_POST['year'];
  $genre  = $_POST['genre'];



    $sql = "UPDATE disc SET disc_title='$album', disc_genre='$genre', disc_year='$year', disc_price='$price' WHERE disc_id='$id'";

    $dsn = connexionBase();
    $dsn->prepare($sql)->execute();
    header('location : localhost/procedural/src/index.php');
  }

 ?>

 <?= entete(
   "Velvet Record | Modifier",
   "../../public/styles/css/bootstrap.min.css",
   "../../public/js/bootstrap.min.js",
     [
       "./../index.php",
       "edition.php",
       "other.php"
     ],
     [
       "Accueil",
       "Editée",
       "Contact"
     ]
   ) ;?>


   <section class="row mt-5">
     <form class="<?= $obj->form ?>" action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" enctype="multipart/form-data">
       <fieldset class="<?= $obj->form_field ?>">
         <legend>Modifier un article</legend>

         <label for="name" class="<?= $obj->form_group;?>">
           <input
             type="text"
             placeholder="Auteur"
             name="name"
             class=" <?= $obj->form_control;?><?= empty($getErrorPrice) ? 'is-invalid' : 'is-valid' ?>">

           <?php if(isset($getErrorAuthor)) :?>
             <span class="invalid-feedback">
               <?=$getErrorAuthor;?>
             </span>
           <?php endif; ?>
         </label>

         <label for="title" class="<?= $obj->form_group;?>">
           <input type="text"
           placeholder="Album"
           name="title" class="<?= $obj->form_control;?><?= empty($getErrorPrice) ? 'is-invalid' : 'is-valid' ?>">

           <?php if(isset($getErrorAlbum)) :?>
             <span class="invalid-feedback">
               <?=$getErrorAlbum;?>
             </span>
           <?php endif; ?>
         </label>

         <label for="genre" class="<?= $obj->form_group;?>">
           <input type="text"
           placeholder="genre musical"
           name="genre"
           class="<?= $obj->form_control;?><?= empty($getErrorPrice) ? 'is-invalid' : 'is-valid' ?>">

           <?php if(isset($getErrorGenre)) :?>
             <span class="invalid-feedback">
               <?=$getErrorGenre;?>
             </span>
           <?php endif; ?>
         </label>

         <label for="year" class="<?= $obj->form_group;?>">
           <input type="date"
           name="year"
           class="<?= $obj->form_control;?> <?= empty($getErrorYear) ? 'is-invalid' : 'is-valid' ?> text-muted">

           <?php if(isset($getErrorYear)) :?>
             <span class="invalid-feedback">
               <?=$getErrorYear;?>
             </span>
           <?php endif; ?>
         </label>

         <label for="price" class="<?= $obj->input_group;?>">
             <input type="text"
               placeholder="ajouter un prix"
               name="price"
               class=" <?= $obj->form_control;?><?= empty($getErrorPrice) ? 'is-invalid' : 'is-valid' ?>">
             <span class="input-group-text">€</span>

           <?php if(isset($getErrorPrice)) :?>
             <span class="invalid-feedback">
               <?=$getErrorPrice;?>
             </span>
           <?php endif; ?>
          </label>

         <label for="upload" class="<?= $obj->form_group;?>">
           <input type="file"
           name="upload"
           class="<?= $obj->form_control;?><?= empty($getErrorPrice) ? 'is-invalid' : 'is-valid' ?> text-info">

           <?php if(isset($getErrorImg)) :?>
             <span class="invalid-feedback">
               <?=$getErrorImg;?>
             </span>
           <?php endif; ?>
         </label>

         <div>
           <input class="<?= $obj->form_btn;?>" type="submit" value="edit" name="up"/>
         </div>
       </fieldset>
     </form>
   </section>

   <?= footer();?>

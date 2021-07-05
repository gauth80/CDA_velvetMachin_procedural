
<?php
  include('templates/fonctions.php');
  require_once('./../config/dsn.php');
  $file = 'styles/formatage/prettyCss.json';
  $data = file_get_contents($file, false);
  $obj = json_decode($data);

?>

<?= entete(
  'Velvet Record | accueil',
  "./styles/css/styles.css",
    [
      "./pages/edition.php",
      "./../actions/create.php",
      "pages/other.php"
    ],
    [
      "Edition",
      "Lorem",
      "Contact",
    ]
  );
?>

      <section class="section mt-5">
        <h1 class="<?= $obj->section_title; ?>">Les articles</h1>
          <article class="<?= $obj->section_card; ?>">
            <?php
              $dsn = connexionBase();
              // view
              $sql = 'SELECT * FROM produits';
              if($request = $dsn->query($sql)) {
                if($request->rowCount() > 0) {
                  while ($row = $request->fetchObject()) { ?>
                    <figure class="<?= $obj->card_content; ?>">
                      <a href=""><img src="./../public/media/img/<?=$row->disc_picture?>" alt="<?=$row->disc_title?>" class="fluid" title="<?=$row->disc_picture?>"></a>
                      <p>Auteur : <?=$row->artist_name;?></p>
                      <p>Album : <?=$row->disc_title;?></p>
                      <p>Genre : <?=$row->disc_genre;?></p>
                      <p>Années de sortie : <?=$row->disc_year;?></p>
                      <p>Prix de l'album : <?=$row->disc_price;?></p>
                      <a href="./../actions/update.php?disc_id=<?=$row->disc_id?>" name="update" class="btn primary">Modifier</a>
                      <a href="delete.php?disc_id=<?=$row->disc_id?>" class="btn primary">Supprimez</a>
                    </figure>
                    <?php } ?>
                  </article>
              <?php
              unset($request);
            } else {
              echo "aucunes données trouvée.";
          }
        } else {
          echo "erreur dans la request";
        }
      unset($dsn);
      ?>
    </section>
  </div>
  <?= footer(); ?>

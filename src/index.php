
<?php
  include('templates/fonctions.php');
  require_once('./../config/dsn.php');
  $file = './../public/styles/formatage/prettyCss.json';
  $data = file_get_contents($file, false);
  $obj = json_decode($data);

?>

<?= entete(
  'Velvet Record | accueil',
  "./../public/styles/css/bootstrap.min.css",
  "./../public/js/bootstrap.min.js",
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

      <section class="row">
        <article class="<?= $obj->main;?>">
          <h1 class="text-center my-5">Les articles</h1>
          <?php
            $dsn = connexionBase();

            // view
            $sql = 'SELECT * FROM produits';
            if($request = $dsn->query($sql)) {
              if($request->rowCount() > 0) {
                while ($row = $request->fetchObject()) { ?>
                  <figure class="<?= $obj->card;?>">
                    <h2 class="<?= $obj->card_title;?>"><?=$row->artist_name;?></h2>
                    <h3 class="<?= $obj->card_subtitle;?>"><?=$row->disc_title;?></h3>
                    <a href="">
                      <img src="./../public/media/img/<?=$row->disc_picture?>" alt="<?=$row->disc_title?>" class="img-fluid" title="<?=$row->disc_picture?>">
                    </a>

                    <div class="accordion" id="anchorCard">
                      <h2 class="<?= $obj->accordion_header;?>" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?=$row->disc_id?>" aria-expanded="true" aria-controls="collapseOne">
                          Description
                        </button>
                      </h2>
                      <div id="collapse-<?=$row->disc_id?>" class="<?= $obj->accordion_collapse;?>" aria-labelledby="headingOne" data-bs-parent="#anchorCard">
                        <div class="accordion-body">
                          <p class="text-muted">Genre : <?=$row->disc_genre;?></p>
                          <p class="text-muted">Années de sortie : <?=$row->disc_year;?></p>
                          <p class="text-muted">Prix de l'album : <?=$row->disc_price;?></p>
                          <a
                            href="./pages/update.php?<?= $row->disc_id ? str_replace(' ', '_', $row->disc_title) : null?>"
                            class="btn btn-outline-info">Modifier
                          </a>

                          <a href="./pages/delete.php?<?= $row->disc_id ? str_replace(' ', '_', $row->disc_title) : null ?>"
                            class="btn btn-outline-danger">Supprimez
                          </a>
                        </div>
                      </div>
                  </div>

                    </div>
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
  <?= footer(); ?>

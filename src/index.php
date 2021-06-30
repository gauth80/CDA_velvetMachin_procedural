  <!DOCTYPE html>
  <html lang="en">
  <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php
    $file = 'styles/formatage/bordel.json';
    $data = file_get_contents($file, false);
    $obj = json_decode($data);
  ?>
  <link rel="stylesheet" href="./styles/css/styles.css">
  <title>velvet record</title>
  </head>
    <body class="container">
      <header class="fixed">
        <nav class="nav">
          <ul class="nav_reset">
            <li class="nav_list">
              <a class="list_link" href="">page 1</a>
            </li>
            <li class="nav_list">
              <a class="list_link" href="">link-2</a>
            </li>
            <li class="nav_list">
              <a class="list_link" href="">link-3</a>
            </li>
          </ul>
        </nav>
      </header>

      <section class="section mt-5">
        <h1 class="<?= $obj->section_title; ?>">Les articles</h1>
          <article class="<?= $obj->section_card; ?>">
            <?php
              require_once('./../config/dsn.php');
              $dsn = connexionBase();
              $sql = 'SELECT * FROM disc LEFT JOIN artist ON disc.disc_id = artist.artist_id';
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
                      <a href="./../actions/update.php?disc_id=<?=$row->disc_id?>" class="btn primary">Modifier</a>
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
</body>
</html>

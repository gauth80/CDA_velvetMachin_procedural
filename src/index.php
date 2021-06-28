  <!DOCTYPE html>
  <html lang="en">
  <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="./styles/css/main.css">
  <title>velvet record</title>
  </head>
  <body class="box">
  <h2 class="section_title">un titre</h2>
  <p class="section_content">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet totam in, officiis repudiandae, quod perspiciatis quas praesentium dolores adipisci ratione omnis at. Odit dolores corporis doloribus, minus nihil quae iste.</p>
  <div class="box">
    <div class="sidebar">
      <nav class="sidebar_nav">
        <ul class="sidebar_block">
          <li class="list_block">
            <a href="/" class="list_link">link-1</a>
          </li>
          <li class="list_block">
            <a href="/" class="list_link">link-2</a>
          </li>
          <li class="list_block">
            <a href="/" class="list_link">link-3</a>
          </li>
          <li class="list_block">
            <a href="/" class="list_link">link-4</a>
          </li>
          <li class="list_block">
            <a href="/" class="list_link">link-5</a>
          </li>
          <li class="list_block">
            <a href="/" class="list_link">link-6</a>
          </li>
        </ul>
      </nav>
    </div>

    <section class="section">
      <article class="card">
        <?php
          require_once('./../config/dsn.php');
          $dsn = connexionBase();
          $sql = 'SELECT * FROM disc LEFT JOIN artist ON disc.disc_id = artist.artist_id';
          if($request = $dsn->query($sql)) {
            if($request->rowCount() > 0) {
              while ($row = $request->fetchObject()) { ?>
                <figure class="card_area">
                  <a href=""><img src="./../public/media/img/<?=$row->disc_picture?>" alt="<?=$row->disc_title?>" class="card_media" title="<?=$row->disc_picture?>"></a>
                  <p>Auteur : <?=$row->artist_name;?></p>
                  <p>Album : <?=$row->disc_title;?></p>
                  <p>Genre : <?=$row->disc_genre;?></p>
                  <p>Années de sortie : <?=$row->disc_year;?></p>
                  <p>Prix de l'album : <?=$row->disc_price;?></p>
                  <a href="update.php?disc_id=<?=$row->disc_id?>" class="btn primary">Modifier</a>
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

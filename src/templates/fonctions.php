<?php
function entete($title,$css, $js, Array $link, Array $navigation) {


  // heredoc
  echo <<< HEADER
  <!DOCTYPE html>
    <html lang="en">
      <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script defer src="$js"></script>
        <link rel="stylesheet" href="$css">
        <title>$title</title>
      </head>
      <body class="container">
        <header class="navbar navbar-expand-lg navbar-dark bg-dark">
          <nav class="collapse navbar-collapse" id="navbarColor02">
            <ul class="navbar-nav me-auto">
              <li class="nav-item">
                <a class="nav-link active" href="$link[0]">$navigation[0]</a>
              </li>
              <li class="nav_list">
                <a class="nav-link" href="$link[1]">$navigation[1]</a>
              </li>
              <li class="nav_list">
                <a class="nav-link" href="$link[2]">$navigation[2]</a>
              </li>
            </ul>
          </nav>
        </header>
  HEADER;
}

function footer() {
  echo <<< FOOTER
        <footer class="card border-info offset-2 col-8 p-3 row">
          <div class="col-12 row">
            <h3>Qui somme nous ?</h3>
            <p class="text-primary">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quibusdam harum hic earum, sed error, fugiat nihil non pariatur, eveniet recusandae nobis accusamus. Optio voluptate nesciunt sunt cumque quo assumenda deleniti.</p>
          </div>
        </footer>
      </body>
    </html>
  FOOTER;
}

?>

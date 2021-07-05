<?php
function entete($title, $meta, Array $link, Array $navigation) {


  // heredoc
  echo <<< HEADER
  <!DOCTYPE html>
    <html lang="en">
      <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="$meta">
        <title>$title</title>
      </head>
      <body class="container">
        <header class="fixed">
          <nav class="nav">
            <ul class="nav_reset">
              <li class="nav_list">
                <a class="list_link" href="$link[0]">$navigation[0]</a>
              </li>
              <li class="nav_list">
                <a class="list_link" href="$link[1]">$navigation[1]</a>
              </li>
              <li class="nav_list">
                <a class="list_link" href="$link[2]">$navigation[2]</a>
              </li>
            </ul>
          </nav>
        </header>
  HEADER;
}

function footer() {
  echo <<< FOOTER
        <footer>
          <div>
            <ul>
              <li>Lorem ipsum.</li>
              <li>Lorem ipsum.</li>
              <li>Lorem ipsum.</li>
              <li>Lorem ipsum.</li>
              <li>Lorem ipsum.</li>
            </ul>
          </div>
        </footer>
      </body>
    </html>
  FOOTER;
}

?>

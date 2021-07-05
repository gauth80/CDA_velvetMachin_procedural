
<?php
  include('../templates/fonctions.php');
  require_once('../../config/dsn.php');
$file = '../styles/formatage/prettyCss.json';
$data = file_get_contents($file, false);
$obj = json_decode($data);
?>

<?= entete(
  "Velvet Record | Autre",
  "./../styles/css/styles.css",
    [
      "./../../actions/create.php",
      "../index.php",
      ""
    ],
    [
      "ajout",
      "Accueil",
      ""
    ]
  ) ;?>


<?= footer() ;?>

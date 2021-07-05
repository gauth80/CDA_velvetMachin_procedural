
<?php
  include('../templates/fonctions.php');
  require_once('../../config/dsn.php');
$file = '../styles/formatage/prettyCss.json';
$data = file_get_contents($file, false);
$obj = json_decode($data);
?>

<?= entete(
  "Velvet Record | detail",
  "./../styles/css/styles.css",
    [
      "./../../actions/create.php",
      "../index.php",
      "other.php"
    ],
    [
      "ajout",
      "Accueil",
      "As propos"
    ]
  ) ;?>


<?= footer() ;?>

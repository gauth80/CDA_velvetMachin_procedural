
<?php
    function connexionBase() {
        $domainSourceName = "mysql:host=localhost;port=3306;dbname=record;charset=utf8";
        $user = 'root';
        $mdp = '';

    try {
        $dsn = new PDO($domainSourceName,$user,$mdp);
        $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dsn;
        echo "vous êtes connectée";
    }

    catch(PDOException $e) {
        echo "<span>Connexion expirée : </span>".$e->getMessage();
        die();
    }

    }

?>

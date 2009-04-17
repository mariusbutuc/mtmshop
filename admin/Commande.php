<?php

   session_start();
   require_once('../include/Fonctions.inc.php');
   require_once('../include/FonctionsDB.inc.php');

    //on recupere la commande passeé dans l'url on la
    //re transforme en objet,
    $c = urldecode($_GET['cmd']);
    $commande = unserialize($c);

    $tabIdProduits=array();

    $connexion = initDB();
    //on recupere les produits de la commande
    $result = query("SELECT id_prod,quantite FROM commande_produit
                     WHERE id_comm='".$commande->getId()."'");

    while($ligne = mysql_fetch_assoc($result))
    {
        $tabIdProduits[] = $ligne['id_prod'];
        $tabQteProduits[]= $ligne['quantite'];

    }

    //on recupere le nom du client qui a passé la commande
    $result = query("SELECT nom,prenom from client WHERE id IN
                    (SELECT id_client FROM commande WHERE id='".$commande->getId()."')");



    fermerDB($connexion);
?>
<html>
    <head>
        <title>Details de la  Commande #<?php echo $commande->getId(); ?></title>
        <meta http-equiv="Content-type" content="text/html; charset=iso-8859-1">
    </head>

    <body>

        <p align="center"><b>Commande #<?php echo $commande->getId(); ?></b><br /><br />
            <a href="accueil.php">Retour à la page d'accueil</a>
        </p>

        <p align="center">
            <ul>
            <?php
                $i=1;
                foreach($tabCommandes as $commande)
                {   //on recupere chaque objet commande, que
                    //l'on serialise, puis pas en parametre
                    // par la méthode GET, à  Commande.php
                    $cmd=serialize($commande);
                    echo "\t<li><a href='Commande.php?cmd=".urlencode($cmd)."'>Commande $i</a></li>\n";
                    $i++;
                }
            ?>
            </ul>
        </p>



    </body>
</html>

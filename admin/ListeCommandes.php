<?php

   session_start();

   require_once('../config/config.inc.php');
   require_once('../include/Fonctions.inc.php');

    $tabCommandes=array();
    $nbCommandes;
    
    openDB($dbURL,$dbUName,$dbPWord);
    selectDB($dbName);

    //on recupere les commandes
    $result = query("SELECT * FROM commande");
    $nbCommandes;
    while($ligne = mysql_fetch_assoc($result))
    {
        $id_commande = $ligne['id'];
        $id_client = $ligne['id_client'];
        $date      = $ligne['prix'];
        $montant = $ligne['unite_vente'];

        //maintenant on construit l'objet produit, et on l'ajoute au tableau des produits

        $tabProduits[]=new Commande($id_commande,$id_client,$date,$montant);
        $nbCommandes++;

    }

    closeDB();
?>
<!DOCTYPE HTML
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
        <title>mtmShop</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css" />
    </head>

    <body>
        <div id="all">
            <div id="header">
                <h1>Page Admin- mtmShop</h1>



                <form action="" method="get" name="search" id="search">
                    <input type="text" value="Recherche..." onfocus="this.value=''" name="q" id="q" />
                    <input type="submit" value="" id="search_but" />
                </form>
                <ul>
                    <li><a href="../Accueil.php">Accueil</a></li>
                    <li><a href="#">Produits</a></li>
                    <li><a href="#">Mon compte</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>

            <div id="content">
                <?php

                if(!isset($_SESSION['rubriques']))
                    $_SESSION['rubriques']=getRubriques($dbURL,$dbUName,$dbPWord,$dbName);

                //tableau contenant les infos sur les rubriques
                $tabRubriques=$_SESSION['rubriques'];


                ?>
                <!--  Navigation  -->

                <div id="nav">
                    <h2>Rubriques</h2>
                    <ul>
                        <?php
                            //on affiche chaque rubrique
                            foreach($tabRubriques as $rubrique)
                            {
                                //$nomRub=$rubrique->getNom();
                                echo "<li><a href='../Rubrique.php?nom=$rubrique' alt='Allez � cette rubrique'>$rubrique</a></li>";
                            }

                        ?>
                    </ul>

                    <h2>Information</h2>

                    <ul>
                        <li><a href="./">Conditions d'utilisation</a></li>
                        <li><a href="./">Contact</a></li>
                    </ul>
                </div>

                <div>
                   <h1>Page d'Administration</h1>

                    <p align="center"><b>Liste des commandes</b><br /><br />
                        Il y'a <?php echo $nbCommandes;?> commandes enregistr�es )<br/>
                        <a href="accueil.php">Retour � la page d'accueil</a>
                    </p>

                    <p align="center">
                        <ul>
                        <?php
                            $i=1;
                            foreach($tabCommandes as $commande)
                            {   //on recupere chaque objet commande, que
                                //l'on serialise, puis pas en parametre
                                // par la m�thode GET, �  Commande.php
                                $cmd=serialize($commande);
                                echo "\t<li><a href='Commande.php?cmd=".urlencode($cmd)."'>Commande $i</a></li>\n";
                                $i++;

                            }
                        ?>
                        </ul>
                    </p>

                </div>

                <div class="clear">
                </div>

            </div>

			<div id="footer">
			    <p class="right aright"> <a href="../Saisie.php">Creer un compte</a> | <a href="../Login">Se connecter</a></p>
			    <p>&copy; 2009 <a href="../Accueil.php">mtmShop</a> | <a href="./">Conditions d'utilisation</a></p>
			</div>
        </div>
    </body>
</html>





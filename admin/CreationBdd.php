<?php
    session_start();

   require_once('../config/config.inc.php');
   require_once('../include/Fonctions.inc.php');
   require_once('InsererTables.inc.php');

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
                                echo "<li><a href='../Rubrique.php?nom=$rubrique' alt='Allez à cette rubrique'>$rubrique</a></li>";
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
                        <?php

                          openDB($dbURL,$dbUName,$dbPWord);
                          // Suppression / Création/ selection de la base
                          query("DROP DATABASE IF EXISTS $dbName");
                          query("CREATE DATABASE $dbName");

                          selectDB($dbName);

                         // Création des tables de la base
                          creer_tables("../config/Tables.sql");

                          $fp=fopen("../config/Parametres.txt","r")
                          or die("Impossible d'ouvrir le fichier 'Parametres.txt'");

                          $nbLignesLues=0;
                          $nbProduits=0;
                          $nbRubriques=0;
                          while(!feof($fp))
                            {
                               $ligne = fgets($fp, 1024);
                               $nbLignesLues++;
                               if(!empty($ligne))
                                  {
                                      if(eregi("^Produit:",$ligne))
                                      {
                                          if(insertion_produit(substr($ligne,8),$nbLignesLues))
                                                $nbProduits++;
                                      }
                                      else if(eregi("^Rubrique:",$ligne))
                                      {
                                           if(insertion_rubrique(substr($ligne,9),$nbLignesLues))
                                                $nbRubriques++;
                                      }
                                      else
                                      {
                                          echo "<p>
                                                    Erreur à la ligne $lignesLues. Mots attendues: 'Produit:' ou 'Rubrique:'
                                                </p>";
                                      }


                                  }
                            }
                          fclose($fp);
                          closeDB();
                        ?>

                        <p align="center"><b>Chargement réussi !</b><br /><br />
                            (ajout de <?php echo $nbProduits;?> produits et <?php echo $nbRubriques;?> rubriques )<br />
                            <a href="accueil.php">Retour à la page d'accueil</a>
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





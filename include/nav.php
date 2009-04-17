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
                    echo "<li><a href='Rubrique.php?nom=$rubrique'>$rubrique</a></li>\n";
                }

            ?>
        </ul>

        <h2>Information</h2>

        <ul>
            <li><a href="./">Conditions d'utilisation</a></li>
            <li><a href="./">Contact</a></li>
        </ul>
    </div>
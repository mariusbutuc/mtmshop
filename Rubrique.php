<?php
    session_start();
    require_once("classes/Panier.php");
    require_once('classes/Descriptif.php');
    require_once('classes/Rubrique.php');
    require_once('classes/Propriete.php');
    require_once('classes/Produit.php');

    require_once("config/config.inc.php");
    require_once('include/Fonctions.inc.php');

    $rubrique=escape($_GET['nom']);

    $tabProduits=array();


    openDB($dbURL,$dbUName,$dbPWord);
    selectDB($dbName);

    //on recupere les produits de la rubrique
    $result = query("SELECT * FROM produit WHERE id IN
                        (SELECT id_prod FROM produit_rubrique  WHERE  id_rubr IN
                            (SELECT id FROM rubrique WHERE nom='$rubrique'))");


    while($ligne = mysql_fetch_assoc($result))
    {
        $id_prod = $ligne['id'];
        $libelle = $ligne['libelle'];
        $prix    = $ligne['prix'];
        $unite_vente = $ligne['unite_vente'];

        //on recupere les descriptifs du produit
        $result2 = query("SELECT nom FROM descriptif WHERE id IN
                            (SELECT id_desc FROM produit_descriptif  WHERE  id_prod='$id_prod')");

       //on cree les objets Descriptif et on les ajoute au tableau des descriptifs du produit
        $tabDescriptifs=array();
        while($ligne2 = mysql_fetch_assoc($result2))
        {
              $tabDescriptifs[]=new Descriptif($ligne2['nom']);
        }



        //on recupere les proprietes du produit
        $result3 = query("SELECT propriete.nom , produit_propriete.valeur_prop
                          FROM   propriete , produit_propriete
                          WHERE  propriete.id IN
                                (SELECT id_prop FROM produit_propriete  WHERE  id_prod='$id_prod')
                            AND produit_propriete.valeur_prop IN
                                (SELECT valeur_prop FROM produit_propriete  WHERE  id_prod='$id_prod')");

        //on cree les objets Propriete et on les ajoute au tableau des rubriques du produit
        $tabProprietes=array();
        while($ligne3 = mysql_fetch_assoc($result3))
        {
            $tabProprietes[]=new Propriete($ligne3['nom'],$ligne3['valeur_prop']);
        }

        //on recupere les autres Rubriques dans lesquelles
        //on peut aussi retrouver le produit
        $result4 = query("SELECT nom FROM rubrique WHERE id IN
                            (SELECT id_rubr FROM produit_rubrique  WHERE  id_prod='$id_prod'
                             AND id_rubr NOT IN (SELECT id FROM rubrique WHERE nom='$rubrique'))");
        //on ajoute l'objet Rubrique au tableau résultat
        $tabRubriques=array();
        while($ligne4 = mysql_fetch_assoc($result4))
        {
            $tabRubriques[]=new Rubrique($ligne4['nom']);
        }

        //maintenant on construit l'objet produit, et on l'ajoute au tableau des produits

        $tabProduits[]=new Produit($id_prod,$libelle,$prix,$unite_vente,$tabDescriptifs,$tabProprietes,$tabRubriques);

    }

    closeDB();

?>

            <?php include 'include/header.php'; ?>

            <div id="content">
                <?php include 'include/nav.php'; ?>


                <div id="produits">
                    <h2>Produits dans '<?php echo $_GET['nom'];?>'</h2>
        <?php
            $nbProduits=count($tabProduits);
            if($nbProduits==0)
                echo "<p>\n
                        \tIl n'a aucun Produits dans cette rubrique!\n
                      </p>";
            else
            {
                for($i=0; $i<$nbProduits; $i++)
                {
                    $id_prod=$tabProduits[$i]->getNumero();
                    $libelle=$tabProduits[$i]->getLibelle();
                    $prix   =$tabProduits[$i]->getPrix();
                    $photo  =$tabProduits[$i]->getPhoto();
                    $unite_vente=$tabProduits[$i]->getUniteVente();

                    //requete d'ajout du produit au panier
                    $requete_ajout="action=add&amp;id_produit=$id_prod&amp;".
                                   "libelle=$libelle&amp;prix=$prix&amp;photo=$photo";
          
        ?>
                    <div class="produit">
                        <h3>
                            <a href="ProduitInfo.php?id_produit=<?php echo $tabProduits[$i]->getNumero(); ?>">
                                <?php echo $tabProduits[$i]->getLibelle(); ?>
                            </a>
                        </h3>
                        
                        <a href="ProduitInfo.php?id_produit=<?php echo $id_prod; ?>">
                            <img alt="<?php echo $id_prod; ?>" src="images/<?php echo $photo; ?>" />
                        </a>
                        
                        <p>
                            <span class="prix"><?php echo $prix; ?>&euro;</span>
                            /<span class="unite"><?php echo $unite_vente; ?></span>
                        </p>
                        <p>Descriptif:</p>

                        <ul>
                            <?php   $tabProduits[$i]->afficherDescriptifs(); ?>                             
                        </ul>

                        <p>Autres Rubriques:</p>

                        <ul>
                            <?php   $tabProduits[$i]->afficherAutresRub(); ?>
                        </ul>

                        <a href="Panier.php?<?php echo $requete_ajout; ?>" class="add2cart">
                            Ajouter au panier
                        </a>
                    </div>
        <?php
                if(($i+1)%3==0)
                {
                    echo "\t\t\t<div class=\"lclear\"></div>\n";
                }
            }
        }
        ?>
                </div>

                <div class="clear">
                </div>

            </div>
            <?php include 'include/footer.php'; ?>





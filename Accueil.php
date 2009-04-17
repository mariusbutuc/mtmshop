<?php
    session_start();
    require_once("classes/Panier.php");
    require_once("config/config.inc.php");
    require_once("include/Fonctions.inc.php");
	include 'include/header.php'; 
?>
            <div id="content">
                <?php include 'include/nav.php'; ?>

                <div id="zoom_produit">

                </div>

                <div id="produits">
                    <h2>Produits</h2>
                    <div class="produit">
                        <h3>
                            <a href="ProduitInfo.php?product_id=17">La barre de Faire</a>
                        </h3>

                        <a href="ProduitInfo.php?product_id=17">
                            <img alt="Produit #2" src="images/barre.jpg" />
                        </a>
                        <p>
                            <span class="prix">&euro;29.90</span>
                            /<span class="unite">l'unite</span>
                        </p>

                        <p>Descriptif:</p>

                        <ul>
                            <li><a href="#">Barre Metalique</a></li>
                            <li><a href="#">Accessoire</a></li>
                            <li><a href="#">Gymnastique</a></li>
                        </ul>

                        <p>Rubriques:</p>

                        <ul>
                            <li><a href="#">Accesoire de gymnastique</a></li>
                            <li><a href="#">Bricolage</a></li>
                        </ul>

                        <a href="Panier.php?action=add&product_id=17" class="add2cart">Ajouter au panier</a>
                    </div>
        <?php
            for($i=2; $i<=6; $i++)
            {
        ?>
                    <div class="produit">
                        <h3>
                            <a href="ProduitInfo.php?product_id=<?php echo $i; ?>">
                                Produit #<?php echo $i; ?>
                            </a>
                        </h3>
                        
                        <a href="ProduitInfo.php?product_id=<?php echo $i; ?>">
                            <img alt="Produit #<?php echo $i; ?>" src="images/no_image.gif" />
                        </a>
                        
                        <p>
                            <span class="prix">prix&euro;</span>
                            /<span class="unite">unite   </span>
                        </p>
                        <p>Descriptif:</p>
                        <ul>
                            <li><a href="#">Descriptif #1</a></li>
                            <li><a href="#">Descriptif #2</a></li>
                            <li><a href="#">Descriptif #3</a></li>
                            <li><a href="#">Descriptif #4</a></li>
                        </ul>
                        <p>Rubriques:</p>
                        <ul>
                            <li><a href="#">Rubrique #1</a></li>
                            <li><a href="#">Rubrique #2</a></li>
                        </ul>
                        <a href="Panier.php?action=add&product_id=<?php echo $i; ?>" class="add2cart">Ajouter au panier</a>
                    </div>
        <?php
                if($i%3==0)
                {
                    echo "\t\t\t<div class=\"lclear\"></div>\n";
                }
            }
        ?>
                </div>

                <div class="clear">
                </div>

            </div>
            <?php include 'include/footer.php'; ?>

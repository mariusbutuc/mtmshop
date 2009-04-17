<?php
    session_start();

    require_once("classes/Panier.php");
    require_once("config/config.inc.php");
    require_once('include/Fonctions.inc.php');

    $panier;
    //si le panier n'existe pas encore, on en cree
    //un, sinon on le recuper de la session.
    if(!isset($_SESSION["panier"]))
    {
        $panier=new Panier();
    }
    else
    {
        $panier=unserialize( $_SESSION["panier"]);
    }

    if(isset($_GET['action']))
    {
        $article = new Article($_GET['id_produit'],$_GET['libelle'],$_GET['prix'],$_GET['photo']);
        $panier->ajouterArticle($article);

    }
    //on enregiste le panier modifier dans la session
    $_SESSION["panier"]=serialize($panier);


?>

            <?php include 'include/header.php'; ?>

            <div id="content">
                <?php include 'include/nav.php'; ?>

                <div id="zoom_produit">

                </div>
                <h2>Produits dans le panier</h2>
                <?php
                    echo "<p>Il y'a ".$panier->getNbArticles()." produits dans le panier</p>";

                if($panier->getNbArticles()!=0)
                {
                ?>
                <div id="produits">
                
                    
                    <form action="Validation.php" method="post">
                    <table width='600' border='1'>
                    	<tr>
                    		<th>Retirer</th>
                    		<th>Produit</th>
                    		<th>Quantite</th>
                    		<th>Total</th>
                    	</tr>
                        
                        <?php
                            $panier->afficher();
                        ?>
                        
                    	<tr>
                            <td colspan="4" align="right">
                                Grand total:<span class="prix"><?php echo $panier->getCoutTotal();?>&euro;</span>
                            </td>
                    	</tr>
                        <tr>
                            <td colspan="4" align="justify"><input type="submit" value="Commander"/></td>
                        </tr>
                    </table>
                    </form>

                </div>
                
                <?php
                    }
                ?>

                <div class="clear">
                </div>

            </div>
            <?php include 'include/footer.php'; ?>






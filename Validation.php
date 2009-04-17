<?php
    session_start();

    require_once("classes/Panier.php");
    require_once("config/config.inc.php");
    require_once('include/Fonctions.inc.php');

  
    //si le client n'est pas connecté, on 
    //dirige vers la page de connexion
    if(!isset($_SESSION["login"]))
    {
        header("Location:http://localhost/Eshopping/Login.php");
    }
    else//sinon, on enregistre la commande
    {
        //on recupere le panier
        $panier=unserialize( $_SESSION["panier"]);

        
        openDB($dbURL,$dbUName,$dbPWord);
        selectDB($dbName);
        
       // on recupere l'id du client
        $result=query("SELECT id FROM client WHERE login='".$_SESSION["login"]."'");
        $d=mysql_fetch_assoc($result);
        if($d)
        {
            $id_client=$d["id"];

            //on insere la commande
            $result=query("INSERT INTO commande(id_client,montant)
                           VALUES ('$id_client','".$panier->getCoutTotal()."')");
              //on recupere son id
            $id_commande=mysql_insert_id();

            //on insere chaque produit de la commande
            $tabArticles=$panier->getTabArticles();

            foreach($tabArticles as $article)
            {
                query("INSERT INTO commande_produit(id_comm,id_prod,quantite)
                       VALUES('$id_commande','".$article->getId()."','".$article->getQuantite()."')");

            }
            //on remet à zero le panier à 0
            unset($_SESSION["panier"]);
        }
    }

?>
            <?php include 'include/header.php'; ?>

            <div id="content">
                <?php include 'include/nav.php'; ?>

                <div >
                    <h2>Commande réussie!</h2>
                    <p>
                        Votre commande a été passée avec succès !<br/>
                        <a href="Accueil.php" alt="Revenir à la page d'accueil">
                            <img src="images/back.png" width="60" height="60" />Retour à la page d'accueil
                        </a>
                </div>

                <div class="clear">
                </div>

            </div>
            <?php include 'include/footer.php'; ?>






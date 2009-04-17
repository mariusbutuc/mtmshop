<!DOCTYPE HTML
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
        <title>mtmShop</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>

    <body>
        <div id="all">
            <div id="header">
                <h1>mtmShop</h1>

                <div id="cart">
                    Mon panier (<a href="Panier.php"><?php echo getNbArticlesPanier();?> Articles</a>)
                </div>

                <form action="" method="get" name="search" id="search">
                    <input type="text" value="Recherche..." onfocus="this.value=''" name="q" id="q" />
                    <input type="submit" value="" id="search_but" />
                </form>
                <ul>
                    <li><a href="Accueil.php">Accueil</a></li>
                    <li><a href="#">Produits</a></li>
                    <li><a href="#">Mon compte</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>